<template>
    <div>
        
        <form 
            @submit.prevent="createAlbum" 
            enctype="multipart/form-data"
            v-if="!success"
        >
            <div class="form-group">
                <label>Name</label>
                <input 
                    type="text" 
                    name="name" 
                    class="form-control"
                    maxlength="15"
                    v-model="name"
                >
                <span v-if="allErrors.name" :class="['danger']">
                    {{ allErrors.name[0] }}
                </span>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea 
                    type="text" 
                    name="description" 
                    class="form-control"
                    rows="6"
                    v-model="description"
                ></textarea>
                <span v-if="allErrors.description" :class="['danger']">
                    {{ allErrors.description[0] }}
                </span>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select 
                    type="text" 
                    name="description" 
                    class="form-control"
                    v-model="category"
                >
                <option 
                    v-for="(category, index) in categories" :key="'categoriesInAlbum' + index" 
                    :value="category.id"
                >
                {{ category.name }}
                </option>
                
                </select>
                <span v-if="allErrors.category" :class="['danger']">
                    {{ allErrors.category[0] }}
                </span>
            </div>
            <div class="form-group">
                <label>Upload Image</label>
                <input 
                    type="file" 
                    name="image" 
                    class="form-control" 
                    v-on:change="onImageChange"
                >
                <span v-if="allErrors.image" :class="['danger']">
                    {{ allErrors.image[0] }}
                </span>
            </div>
            <div class="form-group"> 
                <button type="submit" class="btn btn-secondary">Create Album</button>
            </div>


        </form>

        <div v-else>
            <a :href="'/upload/images/' + albumId">Your album is created. Please click the link to upload the images</a>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name:'',
            description:'',
            category:'',
            image:'',
            categories:[],
            albumId:'',
            success: false,
            allErrors: []
        }

    },
    created() {
        this.getCategories()
    },
    methods: {
        getCategories() {
            axios.get('/api/categories').then((response) => {
                this.categories = response.data;
            }).catch((error) => {
                alert('Unable to fetch categories');
            })
        },
        createAlbum() {
            const config={
                headers: {
                    "content-type": "multipart/form-data"
                }
            }

            let formData = new FormData();
            formData.append('image', this.image);
            formData.append('name', this.name);
            formData.append('description', this.description);
            formData.append('category_id', this.category);

            axios.post('/albums/store', formData, config).then((response) => {
                this.image = '';
                this.name= '';
                this.description = '';
                this.category = '';
                
                //console.log(response.data.id);
                this.albumId = response.data.id;
                this.success = true
            }).catch((error) => {
                console.log(error);
                this.allErrors = error.response.data.errors;
            });
        },
        onImageChange(e) {
            //console.log(e.target.files[0]);
            this.image = e.target.files[0]        
        },
        getUserRecentAvatar() {
            
        }

    }
}
</script>

<style scoped>
    .danger{
        color: red;
        font-size: small;
    }
</style>