<template>
    <div class="flex flex-col items-center">
            <span class="text-sm text-gray-700 dark:text-gray-400">
                Showing Page <span class="font-semibold text-indigo-900">{{meta?.current_page}}</span>
                out of <span
                class="font-semibold text-indigo-900">{{meta?.last_page}}</span> Pages</span>
        <div class="inline-flex mt-2 xs:mt-0">
            <button :class="[isPrev !== null ? 'pagination-btn rounded-l-lg' : 'pagination-btn-disabled rounded-l-lg']" @click="onPrevClicked" :disabled="!isPrev">
                <svg aria-hidden="true" class="mr-2 w-5 h-5" fill="currentColor"
                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                          clip-rule="evenodd">
                    </path>
                </svg>
                Prev
            </button>
            <button :class="[isNext !== null ? 'pagination-btn rounded-r-lg': 'pagination-btn-disabled rounded-r-lg']"
                    @click="onNextClicked"
                    :disabled="!isNext">
            Next
            <svg aria-hidden="true" class="ml-2 w-5 h-5" fill="currentColor"
                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                      clip-rule="evenodd">
                </path>
            </svg>
            </button>
        </div>
    </div>
</template>

<script setup>
    const props = defineProps(
        [
            'onPrevClicked',
            'onNextClicked',
            'isNext',
            'isPrev',
            'meta',
        ]
    )
    const emit = defineEmits(['onPrevClicked','onNextClicked'])

    const onNextClicked = () =>{
        emit('onNextClicked')
    }

    const onPrevClicked = () =>{
        emit("onPrevClicked")
    }
</script>

