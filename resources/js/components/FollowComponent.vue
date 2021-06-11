<template >
    <div class="mt-4">
        <button class="btn btn-primary ml-4" @click.prevent="followUser" v-text="buttonText" ></button>
    </div>
</template>

<script>
export default {
    props:['userId', 'follows'],
    data() {
        return {
            status:this.follows

        }
    },
    computed: {
        buttonText() {
            return (this.status) ? 'Unfollow' : 'Follow';
        }
    },
    methods: {
        followUser() {
            //console.log(this.userId);
            axios.post('/follow', {
                userId: this.userId
            }).then(response=> {
                this.status = !this.status;
            }).catch((error)=> {
                log(error);
            })
        }
    }
}
</script>