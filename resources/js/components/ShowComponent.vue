<template>
    
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-6 pb-4 divCol" v-for="(img, index) in album.albumimages" :key="'albumimages' +index"  >
                    <div class="card">
                        <a 
                            :href="'/images/'+ img.image"
                            data-lightbox="photos"
                        >
                            <div class="imgDiv">
                                <img 
                                    :src="'/images/' +  img.image" 
                                    alt="img.image"
                                >
                            </div>
                        </a>

                        <div class="card-body">
                            <a :href="'/tags/'+img.id" class="btn btn-info btn-outline btn-block ">Add/Edit Tags</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    
</template>


<style lang="scss" scoped>

.card-body{
    .row {
        .divCol {
            .card {
                .imgDiv{
                    position: relative;
                    width:100%;
                    height: 250px;
                        img{
                            position:absolute ;
                            width: 100%;
                        }
                    

                }

                .card-body {
                        z-index: 3 !important;
                        background-color: rgb(250, 250, 250);
                    }

            }

        }

    }
}
</style>


<script>
export default({
    props: ['album'],
    created() {
        //console.log(this.album);
    }
});
</script>


