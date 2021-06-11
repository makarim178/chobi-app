<template>
<div>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 p-4">
            <div class="flex justify-content-center">
                <form method="get" >

                <div class="form-group row">
                    <input 
                        type="text" 
                        name="searchImage" 
                        class="form-control col-sm-8"
                        v-model="searchTag"
                    >
                    <div class="col-sm-2">
                        <button 
                            class="btn btn-primary rounded-circle"
                            type="submit"
                            @click.prevent="getImageByTags"
                        >+</button>

                    </div>

                </div>
                </form>
            </div>
        </div> 
        <div class="col-md-3"></div>
    </div>

    <div class="row">
        <div class="col-md-3 p-4" v-for="(image, index) in images" :key="'homeimagesone' + index">
            <image-card :image="image" :check="check"></image-card>
        </div>
    </div>

    
</div>
</template>



<script>
export default {
    props: ['check'],
    data() {
        return {
            images: [],
            searchTag: null,
            
        }
    },
    created() {
        this.getAllImages();
        
    },
    methods: {
        async getAllImages() {
            await axios.get('/getimage/').then((response)=> {
                //console.log(response.data);
                this.images = response.data;
            });
            
        },
        async getImageByTags() {
            await axios.get('/getimage/'+this.searchTag).then((response) => {
                console.log(response);
                this.images = response.data;
            }).catch((error)=>{
                console.log(error);
            })

        }
    },
    
}
</script>
