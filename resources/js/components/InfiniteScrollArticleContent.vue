
<template>
    <div>
        <div v-for="item in this.content" :key="item.id">
            <div v-html="item.content"></div>
        </div>
        <infinite-loading @distance="1" @infinite="infiniteHandler"></infinite-loading>
    </div>
</template>

<script>
    export default {
        props: {
            apiUrl: {
                type: String,
                default: '',
            },
            isScrollComplete: {
                type: Boolean,
                default: false,
            },
        },
        data() {
            return {
              content: [],
              page: 1,
            };
          },
          methods: {
            infiniteHandler($state) {
                this.$http.get(this.apiUrl+'?page='+this.page)
                    .then(response => {
                        return response.json();
                    })
                    .then(data => {
                        $.each(data.data, (key, value)=> {
                            if (! value) {
                                this.isScrollComplete;
                            }

                            this.content.push(value);
                        });
                        $state.loaded();
                        this.page = this.page + 1;

                        if (! data.data[0]) {
                            $state.complete();
                        }
                    });
            },
          },
    }
</script>
