<script>
    export let name
    export let year
    export let id
    export let price
    export let url
</script>

<div class="p-4 xl:w-1/3 md:w-1/2 w-full">
    <div class="h-full p-6 rounded-lg border-2 border-gray-700 flex flex-col relative overflow-hidden">
        <img alt="Pictrue of {name} car." class="flex-shrink-0 rounded-lg w-full h-48 object-cover object-center mb-2 leading-none" src={url}>
        <div class="flex justify-between">
            <div>
                <h2 class="flex text-lg tracking-widest text-gray-200 title-font mb-1 font-medium px-2">{name}</h2>
                <p class="flex text-gray-400 mb-2 px-2">Year: {year}</p>
            </div>
            <h2 class="flex text-lg tracking-widest text-green-500 title-font mb-1 font-medium px-2">{price}$/day</h2>
        </div>
        <a href="#/carDetails/{id}" class="flex items-center mt-auto text-white bg-green-500 border-0 py-2 px-4 w-full focus:outline-none hover:bg-green-600 rounded">Details
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                <path d="M5 12h14M12 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>
</div>