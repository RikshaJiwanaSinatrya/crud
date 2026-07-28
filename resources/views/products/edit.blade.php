@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="max-w-2xl mx-auto fade-in">
    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-surface-500 hover:text-brand-600 transition-colors mb-4">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Kembali
        </a>
        <h1 class="text-2xl font-extrabold text-surface-900 tracking-tight">Edit Produk</h1>
        <p class="text-surface-500 text-sm mt-1">Perbarui informasi <span class="font-semibold text-surface-700">{{ $product->name }}</span>.</p>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl border border-surface-200 p-6 sm:p-8">
        <form action="{{ route('products.update', $product) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div class="mb-5">
                <label for="name" class="block text-sm font-semibold text-surface-700 mb-2">Nama Produk</label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name', $product->name) }}"
                       required
                       placeholder="Masukkan nama produk"
                       class="w-full px-4 py-3 bg-surface-50 border border-surface-200 rounded-xl text-surface-800 text-sm placeholder:text-surface-400 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-colors">
                @error('name')
                    <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Price --}}
            <div class="mb-5">
                <label for="price" class="block text-sm font-semibold text-surface-700 mb-2">Harga (Rp)</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-semibold text-surface-400">Rp</span>
                    <input type="number"
                           id="price"
                           name="price"
                           value="{{ old('price', $product->price) }}"
                           required
                           min="0"
                           placeholder="0"
                           class="w-full pl-12 pr-4 py-3 bg-surface-50 border border-surface-200 rounded-xl text-surface-800 text-sm placeholder:text-surface-400 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-colors">
                </div>
                @error('price')
                    <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-6">
                <label for="description" class="block text-sm font-semibold text-surface-700 mb-2">Deskripsi <span class="text-surface-400 font-normal">(opsional)</span></label>
                <textarea id="description"
                          name="description"
                          rows="4"
                          placeholder="Ceritakan tentang produk ini..."
                          class="w-full px-4 py-3 bg-surface-50 border border-surface-200 rounded-xl text-surface-800 text-sm placeholder:text-surface-400 focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-colors resize-none">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1.5 font-medium">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-3">
                <button type="submit"
                        class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 bg-brand-600 text-white text-sm font-semibold rounded-xl hover:bg-brand-700 active:bg-brand-800 transition-colors shadow-md shadow-brand-600/20 hover:shadow-brand-600/30">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    Perbarui Produk
                </button>
                <a href="{{ route('products.index') }}"
                   class="px-5 py-3 text-sm font-semibold text-surface-600 bg-surface-100 hover:bg-surface-200 rounded-xl transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
