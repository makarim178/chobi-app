<template>
    <div>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group files text-center" ref="fileform">
                <input type="file" ref="file" multiple="multiple" required>
                <span id="val"></span>
                <a class="btn btn-secondary" @click.prevent="submitFiles()">Upload</a>
            </div>
        </form>
        <progress max="100" style="width: 100%;" :value.prop="uploadPercentage" v-if="uploading"></progress>

        <div class="container">
            <hr class="mt-2 mb-5">
            <div class="row text-center text-lg-left ">
                <div class="col-lg-3 col-md-4 col-6 mt-2" v-for="(image,index) in images" :key="image.image+index">
                    <a href="#">
                        <img :src="'/images/'+image.image" :alt="image.image" class="img-fluid img-thumbnail" >
                    </a>
                    <div class="d-flex justify-content-center mt-2">
                        <button 
                            class="btn btn-danger btn-sm"
                            @click.prevent="removeImage(image.id)"
                        >Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div>
            <add-image></add-image>
        </div> -->
    </div>

    
</template>

<script>
import AddImage from './AddImageComponent.vue';
export default {
  components: { AddImage },
    props: ['album_id'],
    data() {
        return {
            albumId: this.album_id,
            uploadPercentage: '',
            uploading: false,
            images: []
        }
    },
    mounted() {
        this.getImage()
    },
    methods: {
        
        submitFiles() {
            this.uploading = true;
            let formData = new FormData();

            for(var i=0; i<this.$refs.file.files.length; i++) {
                let file = this.$refs.file.files[i];
                formData.append('files['+i+']', file);
                formData.append('album_id', this.albumId);
            }

            this.$refs.file.value = '';
            axios.post('/uploadImage', formData, {
                headers: {
                    "content-type" : "multipart/form-data"
                },
                onUploadProgress:function(progressEvent) {
                    this.uploadPercentage = parseInt(Math.round((progressEvent.loaded*100)/progressEvent.total));
                }.bind(this)
            }).then((response)=> {
                this.getImage();
            });
        },
        getImage() {
            axios.get('/getimages').then((response) => {
                this.images = response.data
            }).catch((error) => {
                console.log(error);
            })
        },
        removeImage(id) {
            Swal.fire({
                title: 'Are you Sure?',
                icon: 'warning',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it",
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                position: 'center'
            }).then((result)=> {
                if(result.value) {
                    axios.delete('/image/'+id)
                    .then((response) => {
                        this.getImage();
                        Swal.fire({
						  position: 'center',
						  icon: 'success',
						  title: 'Your album is removed!',
						  showConfirmButton: false,
						  timer: 1500
						});

                    }).catch((error) => {
                        console.log(error);
                    })
                }
            });
        }

    }
}
</script>