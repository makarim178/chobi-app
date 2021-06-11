<template>
    <div >
            Go back to <a href="/albums" class="text-decoration-none">Album list</a>
        <form method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12 p-4">
                <div class="card ">
                    <div class="d-flex justify-content-center">
                        <img
                            class="img img-thumbnail" 
                            :src="'/images/' + image.image" 
                            :alt="image.image"
                            width="50%"
                        >

                    </div>
                </div>

            </div>
        </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="tags">Tags</label>
                <input type="text" placeholder="Enter tags" name="tags" class="form-control col-sm-8" v-model="tag">
                <div class="col-sm-2">
                    <button class="btn btn-primary rounded-circle" type="submit" @click.prevent="addToTag">+</button>
                </div>
            </div>
        </form>

        <div class="row" v-if="tags.length>0">
            <div class="col-md-2">
                <h4>Tags Added</h4>
            </div>
            <div class="col-md-4">
                <div class="card text-center p-2" >
                    <span                        class="text-decoration-none cursor" 
                        v-for="(item, index) in tags" 
                        :key="'tagItems' + index"
                    >
                        {{item}}
                        <a @click="removeTag(item)" class="btn btn-outline btn-danger badge btn-sm rounded-circle">X </a>
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <button :disabled="!enableSave"
                    class="btn btn-primary btn-block"
                    @click.prevent="addTags"
                >
                    Save Tags
                </button>
            </div>
            
        </div>
    </div>
</template>

<script>
export default {
    props: ['image'],
    data() {
        return {
            tag: null,
            tags: [],
            enableSave: false
        }
    },
    created() {
        this.image.imagetags.forEach(elements => {
            this.tags.push(elements.tag);
        });

    },
    methods: {
        checkSaveOptions() {
            if (this.tags.length === this.image.imagetags.length) {
                this.image.imagetags.forEach(elements => {
                    this.tags.forEach(el => {
                        
                        if(el !== elements) {
                            
                            return this.enableSave = true;
                        }
                    })
                });
                            console.log('hey');
                    return this.enableSave = false;
            }
            this.enableSave = true;
        },
        removeTag(tag) {
            var index = this.tags.indexOf(tag);
            if(index > -1) {
                this.tags.splice(index,1);
            }
            this.checkSaveOptions();
        },
        addToTag() {
            this.tags.push(this.tag);
            this.tag = null;
            this.checkSaveOptions();
        },
        addTags () {
            this.enableSave = false;
            let formData = new FormData();
            this.tags.forEach((element,index) => {
                formData.append('tags['+index+']', element);
                console.log(element);
            });
            axios.post('/addtags/' + this.image.id, formData).then((response)=> {
                if(response.status === 200) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Tags have been updated',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }).catch((error) => {
                console.log(error);
            });
        },
    },
}
</script>