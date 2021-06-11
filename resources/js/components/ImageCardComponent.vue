<template>
    <div class="card">
        <div class="cardImg">
            <a 
                :href="'/images/'+ image.image"
                data-lightbox="photos"
            >
            <div class="imgDiv">
                <img :src="'/images/' + image.image" alt="" class="img img-thumbnail">
            </div>
            </a>
        </div>

        <div class="cardbody" v-if="check">
            <button 
                class="btn btn-info btn-block" 
                @click.prevent="likeImage(image.id)"
                v-text="buttonText"
            ></button>
        </div>
    </div>
</template>

<style lang="scss" scoped>


.card{ 
    .cardImg{
        .imgDiv{
            position: relative;
            width: 100% ;
            height: 200px;
            display: flex;
            justify-content:center;
            align-items:center;
            overflow:hidden;
            img{
                height: 100%;
                object-fit: contain;
            }
        }
    }
}

</style>

<script>
export default {
    props:['image', 'check'],
    data() {
        return {
            status: false,
        }
    },
    created() {
        if(this.check) {
            this.doIlike();
        }
    },
    
    methods: {
        async likeImage(imageid) {
            //console.log(imageid);
            // //console.log(this.userId);
            await axios.post('/like', {
                imageid: imageid
            }).then((response)=> {
                //console.log(response);
                this.status = !this.status;
            }).catch((error)=> {
                log(error);
            })
        },
        async doIlike() {
            await axios.get('/doilike/' + this.image.id).then((response)=> {
                this.status = response.data.status;
            }).catch((err) => {
                console.log(err);
            })
        }
    },

    computed: {
        buttonText() {
            return (this.status) ? 'Unlike' : 'Like';
        }

    },
    
}
</script>
