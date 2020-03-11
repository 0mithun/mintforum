<template>

   <button class="btn btn-xs btn-default">
            <!-- <span class="glyphicon glyphicon-thumbs-down like-icon" :class="dislikeClass">&nbsp;{{ dislikesCount }}</span>
             -->
              <span :class="classes"  class="glyphicon glyphicon-heart "  @click="toggle"></span>
    </button>

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
            }
        },

        methods: {
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