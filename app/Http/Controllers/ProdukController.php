<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function show($id)
    {
        $produk = Product::findOrFail($id);
        return view('produk.detail', compact('produk'));
    }
    public function index(Request $request)
    {
        $query = Product::query();
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%$search%")
                  ->orWhere('name', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%")
                  ->orWhere('price', 'like', "%$search%") ;
            });
        }
        $user = Auth::user();
        if (!($user && $user->role === 'superadmin')) {
            $query->where(function($q) {
                $q->whereNull('is_hidden')->orWhere('is_hidden', 0);
            });
        }
        $produks = $query->with(['product_group', 'module'])->orderByDesc('id')->paginate(10);
        $groups = DB::table('product_groups')->get();
        $modules = DB::table('modules')->get();
        $currencies = \App\Models\Currency::all();
        if ($user && $user->role === 'superadmin') {
            return view('produk.index', compact('produks', 'groups', 'modules', 'currencies'));
        }
        return view('produk.card', compact('produks'));
    }

    public function create()
    {
        $groups = DB::table('product_groups')->get();
        $modules = DB::table('modules')->get();
        return view('produk.create', compact('groups', 'modules'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_group_id' => 'nullable|exists:product_groups,id',
            'product_code' => 'nullable|string|max:100|unique:products,product_code',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'description' => 'nullable|string',
            'type' => 'required|string|max:100',
            'module_id' => 'nullable|exists:modules,id',
            'status' => 'nullable|string|max:50',
            'is_hidden' => 'nullable|boolean',
            'tax_type' => 'nullable|in:include,exclude',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'payment_type' => 'required|in:free,onetime,recurring',
        ]);

        $validated['is_hidden'] = $request->has('is_hidden') ? 1 : 0;
        if (!isset($validated['status'])) {
            $validated['status'] = 'active';
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->storeAs('public/products', $imageName);
            $validated['image'] = 'products/'.$imageName;
        }

        // Hapus kolom price dari $validated jika ada (harga diatur di tabel product_prices)
        unset($validated['price']);

        $product = Product::create($validated);
        // Attach tax sesuai tax_type
        if (!empty($validated['tax_type'])) {
            $tax = \App\Models\Tax::where('type', $validated['tax_type'])->where('status', 'active')->first();
            if ($tax) {
                $product->taxes()->sync([$tax->id]);
            } else {
                $product->taxes()->detach();
            }
        } else {
            $product->taxes()->detach();
        }

        // Simpan detail pricing
        if ($validated['payment_type'] === 'free') {
            // Free: satu harga saja, currency default (misal IDR)
            $product->prices()->create([
                'currency' => 'IDR',
                'period' => 'onetime',
                'setup_fee' => 0,
                'price' => $request->input('free_price', 0),
                'enabled' => 1,
            ]);
        } elseif ($validated['payment_type'] === 'onetime') {
            // One time: per currency
            $onetime = $request->input('onetime', []);
            foreach ($onetime as $currency => $row) {
                $product->prices()->create([
                    'currency' => $currency,
                    'period' => 'onetime',
                    'setup_fee' => $row['setup_fee'] ?? 0,
                    'price' => $row['price'] ?? 0,
                    'enabled' => isset($row['enabled']) ? 1 : 0,
                ]);
            }
        } elseif ($validated['payment_type'] === 'recurring') {
            // Recurring: per currency, per period
            $recurring = $request->input('recurring', []);
            foreach ($recurring as $currency => $periods) {
                foreach ($periods as $period => $row) {
                    $product->prices()->create([
                        'currency' => $currency,
                        'period' => $period,
                        'setup_fee' => $row['setup_fee'] ?? 0,
                        'price' => $row['price'] ?? 0,
                        'enabled' => isset($row['enabled']) ? 1 : 0,
                    ]);
                }
            }
        }

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $produk = Product::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Product::findOrFail($id);
        $validated = $request->validate([
            'product_group_id' => 'nullable|exists:product_groups,id',
            'product_code' => 'nullable|string|max:100|unique:products,product_code,' . $id,
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $id,
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'type' => 'required|string|max:100',
            'module_id' => 'nullable|exists:modules,id',
            'status' => 'nullable|string|max:50',
            'is_hidden' => 'boolean',
        ]);
        $validated = $request->validate([
            'product_group_id' => 'nullable|exists:product_groups,id',
            'product_code' => 'nullable|string|max:100|unique:products,product_code,' . $id,
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $id,
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'type' => 'required|string|max:100',
            'module_id' => 'nullable|exists:modules,id',
            'status' => 'nullable|string|max:50',
            'is_hidden' => 'boolean',
            'tax_type' => 'nullable|in:include,exclude',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Handle image upload on update
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->storeAs('public/products', $imageName);
            $validated['image'] = 'products/'.$imageName;
        }
        $produk->update($validated);
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy($id)
    {
        $produk = Product::findOrFail($id);
        if ($produk->image) {
            Storage::disk('public')->delete($produk->image);
        }
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
