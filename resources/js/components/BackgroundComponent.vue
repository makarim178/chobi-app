<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="card-body">
                    <img 
                        class="img img-thumbnail m-4" 
                        :src="bgImage" 
                        :alt="userid + bgImage" 
                        width="120"
                        v-if="bgImage"
                    >
                    <form 
                        @submit.prevent="updateBgPic" 
                        method="post"
                        enctype="multipart/form-data"
                    >
                    <div class="form-group">
                        <input 
                            type="file" 
                            :name="image" 
                            class="form-control"
                            v-on:change="onImageChange"
                        >
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['userid'],
    data() {
        return {
            image: '',
            bgImage: null
        }
    },
    mounted() {
        this.getUserRecentBgImage();

    },
    methods: {
        onImageChange(e) {
            this.image = e.target.files[0];
        },
        async updateBgPic() {
            //alert(this.userid);
            const config = {
                Headers : {
                    "content-type": "multipart/form-data"
                }
            }
            let formData = new FormData();
            formData.append('image', this.image);
            await axios.post('/bg-pic', formData, config).then((response) => {
                this.image = '';
                this.getUserRecentBgImage()

            }).catch((error) => {
                alert('Unable to update profile picture');
            })
        },
        getUserRecentBgImage() {
            axios.get('/user/bg/'+ this.userid).then((response) => {
                if(response.data) this.bgImage = '/storage/' + response.data.substr(7);
            }).catch((error) => {
                console.log(error);
                alert('error');
            })
        }
    }
}
</script>