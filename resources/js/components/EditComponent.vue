<template>
    <div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  enctype="multipart/form-data" @submit.prevent="updateAlbum" >
                        <div class="form-group">
                            <label>Name of Album</label>
                            <input type="text" name="name" class="form-control" maxlength="15" required v-model="name">
                        </div>
                        <div class="form-group">
                            <label>Description of Album</label>
                            <textarea class="form-control"  maxlength="200" name="description" required v-model="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Category of Album</label>
                            <select class="form-control" name="category" v-model="category" >
                                <option v-for="(cat, index) in categories" :key="'categoryInModal' + index" :value="cat.id">
                                    {{ cat.name }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Image of Album</label>
                            <input type="file" name="image" class="form-control" v-on:change="onImageChange" >
                        </div>
                        <div class="form-group">
                            <button class="btn btn-secondary" type="submit">Update Album</button>
                        </div>
                        
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['album'],
    data() {
        return{
            name: this.album.name || null,
            description: this.album.description || null,
            category: this.album.category.id,
            image: null,
            categories: [],
        }
    },
    created() {
        this.getCategories();
    },
    methods: {
        getCategories() {
            axios.get('/api/categories').then((response) => {
                this.categories = response.data;
            }).catch((error) => {
                alert('Unable to fetch Categories');
            });
        },
        async updateAlbum() {
            //alert("hi!");
            const config ={ 
                headers: {
                    "content-type": "multipart/form-data"
                }
            }

            //console.log(this.category);

            let formData = new FormData();
            formData.append('image', this.image);
            formData.append('name', this.name);
            formData.append('description', this.description);
            formData.append('category_id', this.category);
            formData.append('_method', "put");

            await axios.post('/albums/' + this.album.id + '/edit', formData, config)
                .then((response) => {
                    console.log(response);
                    $('#exampleModal').modal('hide');
                    this.$emit('recordUpdated', response);

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Your changes has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    });


                }).catch((error)=> {
                    console.log(error);
                });
        },
        onImageChange(e) {
            this.image = e.target.files[0];
        }
    }
}
</script>