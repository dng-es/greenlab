<template>
    <div class="orderby-container">
        <span v-bind:class="{ active: (field==orderby && order=='DESC') }" class="orderby-up"><a :href="'?order=DESC&orderby=' + field + '&search=' + search">&#9652;</a></span>
        <span v-bind:class="{ active: (field==orderby && order=='ASC') }" class="orderby-down"><a :href="'?order=ASC&orderby=' + field + '&search=' + search">&#9662;</a></span>
    </div>
</template>

<script>
    module.exports = {
        
        props: {
            field:{
                type: String,
                default : ''
            },
            orderby:{
                type: String,
                default : ''
            },
            order:{
                type: String,
                default : ''
            },
            search:{
                type: String,
                default : ''
            },
        },
        data: function () {
            return {
            };
        }
        
    }
</script>
