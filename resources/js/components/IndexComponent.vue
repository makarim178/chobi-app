<template>
    <div>
        <table class="table table-image">
            <thead>
                <tr>
                    <th scope="col">SN</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category</th>
                    <!-- <th scope="col">View</th>
                    <th scope="col">Uplaod Image(s)</th> -->
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(album, index) in albums" :key="'allmyAlbums' + index">
                    <th scope="row">{{index + 1}}</th>
                    <td class="w-25">
                        <img :src="'/album/' + album.image" :alt="album.name" width="100" class="img-fluid img-thumbnail">
                    </td>
                    <td> {{ album.name }} </td>
                    <td> {{ album.description.substring(0,25) }} </td>
                    <td>{{album.category.name}}</td>
                    <td>

                        <a :href="'/albums/' + album.slug + '/' + album.id">
                            <button class="btn btn-info">View Image/tags</button>
                        </a>

                        <a :href="'/upload/images/' + album.id">
                            <button class="btn btn-success">Upload Images</button>
                        </a>

                        <button 
                            @click.prevent="edit(album)"
                            type="button" 
                            class="btn btn-primary" 
                            data-toggle="modal"
                            data-target="#exampleModal"
                        >Edit</button>

                        <button 
                            class="btn btn-danger"
                            type="button"
                            @click.prevent="deleteAlbum(album.id)"
                        >Remove</button>
                    </td>
                </tr>
            </tbody>

        </table>
        <div class="d-flex justify-content-center">
            <pagination :meta="meta" v-on:pagination="getAlbums" ></pagination>
        </div>
        <edit v-if="records" :album="records" @recordUpdated="recordUpdated"></edit>
        
    </div>
</template>

<script>
export default {
    data() {
        return {
            albums: [],
            records: null,
            meta: {}
        }
    },
    created() {
        this.getAlbums();
    },
    methods: {
        getAlbums(page) {
            axios.get('/getalbums', {params:  {page}}).then((response) => {
                    this.albums = response.data.data
                    this.meta = response.data.meta
                }).catch((error) => {
                    console.log(error);
                });
        },
        edit(album) {
            // alert(id);
            this.records = album;
        },
        recordUpdated(response) {
            this.albums = response.data;
        },
        deleteAlbum(id) {
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
                    axios.delete('/albums/'+id+'/delete')
                    .then((response) => {
                        Swal.fire({
						  position: 'center',
						  icon: 'success',
						  title: 'Your album is removed!',
						  showConfirmButton: false,
						  timer: 1500
						});

                        this.albums = response.data;
                    }).catch((error) => {
                        console.log(error);
                    })
                }
            });
        }
    }
}
</script>