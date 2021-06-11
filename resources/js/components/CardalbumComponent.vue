<template>
    <div>
        <div class="card">
            <div class="cardImg p-2">
                <div class="imgDiv">
                    <img :src="'/album/' + album.image" alt="" class="card-image-top">
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    <center>{{album.name}}</center>
                </h5>
                <p>{{album.description.substring(0,100) }}</p>
                <center>
                    <a :href="albumlink" class="btn btn-primary">View Album</a>
                </center>
            </div>
        </div>
    </div>

    
</template>

<style lang="scss" scoped>
.card{
    .cardImg{
        .imgDiv{
            position: relative;
            width: 100%;
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
    props: ['album','albumlink'],
}
</script>