<template>
    <!-- <button class="btn btn-xs btn-default" style="padding:0px">
    <!-- <span :class="classes"  class="glyphicon glyphicon-heart "  @click="toggle"></span> -->
        <!-- <i class="fa fa-facebook-square" aria-hidden="true"></i> -->
    <!-- </button> -->

    <a :href="threadUrl" target="_blank" class="btn btn-xs btn-default" style="padding:0px" @click="share"    >
        <i class="fa fa-facebook-square" aria-hidden="true"></i>
    </a>


</template>

<script>
    export default {
        props: {
            thread:{
                type:Object
            }
        },


        data() {
            return {
                active: this.thread.isFavorited,

            }
        },

        computed: {
            classes() {
                return [
                    this.active ? 'red-icon' : 'grey-icon'
                ];
            },

            endpoint() {
                return '/thread/' + this.thread.id + '/favorites';
            },
            threadUrl(){
                return 'https://www.facebook.com/sharer/sharer.php?u='+ this.thread.path
            }
        },

        methods: {
             share(){
                window.open(this.threadUrl, 'Share on Twitter', 'width=600, height=400')
            },
            toggle() {
                this.active ? this.destroy() : this.create();
            },

            create() {
                axios.post(this.endpoint).then((res)=>{
                });

                this.active = true;
                flash('You are successfully favorite this thread','success')
                //this.count++;
            },

            destroy() {
                axios.delete(this.endpoint);

                this.active = false;
                flash('You are successfully un favorite this thread','success')
                //this.count--;
            }
        }
    }
</script>