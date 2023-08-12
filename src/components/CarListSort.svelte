<script>
    export let carsSort
</script>

<div class="flex ml-6 items-center">
    <span class="mr-3">Sort by:</span>
    <div class="relative">
        <select on:change={carsSort} class="rounded border border-gray-700 focus:ring-2 focus:ring-green-900 bg-gray-900 appearance-none py-2 focus:outline-none focus:border-green-500 text-white pl-3 pr-10">
            <option value="lp">lowest price</option>
            <option value="hp">highest price</option>
            <option value="nf">newest first</option>
            <option value="of">oldest first</option>
        </select>
        <span class="absolute right-0 top-0 h-full w-10 text-center text-gray-600 pointer-events-none flex items-center justify-center">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4" viewBox="0 0 24 24">
                <path d="M6 9l6 6 6-6"></path>
            </svg>
        </span>
    </div>
</div>