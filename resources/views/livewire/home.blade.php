<div class="m-3">
    <div class="flex justify-between">
    <h1 class="text-[20px] font-semibold tracking-tight fi-header-heading text-gray-950 dark:text-white mb-3">Duplicate Record Type</h1>
    <h1 class="text-[20px] text-right font-semibold tracking-tight fi-header-heading text-gray-950 dark:text-white mb-3"><a href="{{ route('product-fqz') }}">Add FAQ's</a></h1>
    </div>
    <x-filament::input.wrapper class="w-[30%]">
        <x-filament::input.select wire:model.live="status">
            <option value="">-- Select option --</option>
            <option value="products">Product</option>
            <option value="categories">Categories</option>
            <option value="coupons">Coupon</option>
        </x-filament::input.select>
    </x-filament::input.wrapper>


    <div class="grid flex-1 auto-cols-fr gap-y-8 mt-5">
        <div class="flex flex-col gap-y-6">
            <div ax-load="" ax-load-src="http://127.0.0.1:8002/js/filament/tables/components/table.js?v=3.2.62.0" x-data="table" class="fi-ta">
                <div class="fi-ta-ctn divide-y divide-gray-200 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:divide-white/10 dark:bg-gray-900 dark:ring-white/10">
                    <div class="fi-ta-content relative divide-y divide-gray-200 overflow-x-auto dark:divide-white/10 dark:border-t-white/10">
                        @if ($data)
                        <table class="fi-ta-table w-full table-auto divide-y divide-gray-200 text-start dark:divide-white/5">
                            <thead class="divide-y divide-gray-200 dark:divide-white/5">
                                <tr class="bg-gray-50 dark:bg-white/5">
                                    <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 fi-table-header-cell-name">
                                        <span class="group flex w-full items-center gap-x-1 whitespace-nowrap justify-start">
                                            <span class="fi-ta-header-cell-label text-sm font-semibold text-gray-950 dark:text-white">
                                                Name
                                            </span>
                                        </span>
                                    </th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">
                                @foreach ($data as $value)
                                <tr>
                                    <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-table-cell-name" wire:key="KVSDeOITeuuQaX2ld1NJ.table.record.01hze7jh5xg7vzqm60q3nk497q.column.name">
                                        <div class="fi-ta-col-wrp">
                                            <div class="fi-ta-text grid w-full gap-y-1 px-3 py-4">
                                                <div class="flex ">
                                                    <div class="flex max-w-max" style="">
                                                        <div class="fi-ta-text-item inline-flex items-center gap-1.5  ">
                                                            <span class="fi-ta-text-item-label text-sm leading-6 text-gray-950 dark:text-white">
                                                                {{$value['name']['en'] ?? $value['coupon_code']}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="fi-ta-cell p-0 first-of-type:ps-1 last-of-type:pe-1 sm:first-of-type:ps-3 sm:last-of-type:pe-3 fi-ta-actions-cell">
                                        <div class="whitespace-nowrap px-3 py-4">
                                            <div class="fi-ta-actions flex shrink-0 items-center gap-3 justify-end cursor-pointer" wire:click="duplicateRecord('{{ $value['id'] }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                                                </svg>

                                                <span class="font-semibold group-hover/link:underline group-focus-visible/link:underline text-sm text-custom-600 dark:text-custom-400" style="--c-400:var(--primary-400);--c-600:var(--primary-600);">
                                                    Duplicate
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p class="p-10 font-semibold">No record found...!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>