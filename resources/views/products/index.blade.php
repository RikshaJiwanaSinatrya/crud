@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="fade-in">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-surface-900 tracking-tight">Daftar Produk</h1>
            <p class="text-surface-500 text-sm mt-1">Kelola semua produk yang tersedia.</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="bg-white border border-surface-200 rounded-xl px-4 py-2.5 flex items-center gap-2.5">
                <div class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></div>
                <span class="text-sm font-semibold text-surface-700">{{ $products->count() }} produk</span>
            </div>
        </div>
    </div>

    @if($products->isEmpty())
        {{-- Empty State --}}
        <div class="bg-white rounded-2xl border border-surface-200 p-12 text-center">
            <div class="w-16 h-16 bg-surface-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8 text-surface-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-surface-800 mb-2">Belum ada produk</h3>
            <p class="text-surface-500 text-sm mb-6 max-w-sm mx-auto">Mulai tambahkan produk pertama untuk mengelola inventaris Anda.</p>
            <a href="{{ route('products.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-brand-600 text-white text-sm font-semibold rounded-xl hover:bg-brand-700 transition-colors shadow-md shadow-brand-600/20">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Produk Pertama
            </a>
        </div>
    @else
        {{-- Product Grid --}}
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($products as $product)
                <div class="group bg-white rounded-2xl border border-surface-200 hover:border-brand-200 hover:shadow-lg hover:shadow-brand-500/5 transition-all duration-200 overflow-hidden">
                    <div class="p-5">
                        {{-- Price Badge --}}
                        <div class="flex items-start justify-between mb-3">
                            <span class="inline-flex items-center px-3 py-1 bg-brand-50 text-brand-700 text-sm font-bold rounded-lg">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                            <span class="text-xs text-surface-400 font-medium">#{{ $product->id }}</span>
                        </div>

                        {{-- Name --}}
                        <h3 class="text-lg font-bold text-surface-900 mb-2 group-hover:text-brand-700 transition-colors">
                            {{ $product->name }}
                        </h3>

                        {{-- Description --}}
                        <p class="text-sm text-surface-500 leading-relaxed line-clamp-2 mb-4">
                            {{ $product->description ?: 'Tidak ada deskripsi.' }}
                        </p>

                        {{-- Meta --}}
                        <div class="flex items-center gap-2 text-xs text-surface-400 mb-4">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $product->created_at->diffForHumans() }}
                        </div>

                        {{-- Divider --}}
                        <div class="border-t border-surface-100 pt-4 flex items-center gap-2">
                            <a href="{{ route('products.edit', $product) }}"
                               class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 text-sm font-semibold text-surface-600 bg-surface-50 hover:bg-surface-100 rounded-xl transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="flex-1"
                                  onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 text-sm font-semibold text-red-600 bg-red-50 hover:bg-red-100 rounded-xl transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
