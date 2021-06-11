<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="card-body">
                    <img class="img img-thumbnail m-4" :src="userImage" :alt="userid + userImage" width="120">
                    <form 
                        @submit.prevent="updateProfilePic" 
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
            userImage: null
        }
    },
    mounted() {
        this.getUserRecentAvatar();

    },
    methods: {
        onImageChange(e) {
            this.image = e.target.files[0];
        },
        async updateProfilePic() {
            //alert(this.userid);
            const config = {
                Headers : {
                    "content-type": "multipart/form-data"
                }
            }
            let formData = new FormData();
            formData.append('image', this.image);
            await axios.post('/profile-pic', formData, config).then((response) => {
                this.image = '';
                this.getUserRecentAvatar()

            }).catch((error) => {
                alert('Unable to update profile picture');
            })
        },
        getUserRecentAvatar() {
            axios.get('/user/'+ this.userid).then((response) => {
                this.userImage = '/storage/' + response.data.substr(7);
            }).catch((error) => {
                console.log(error);
                alert('error');
            })
        }
    }
}
</script>