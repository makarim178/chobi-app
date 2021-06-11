<template>
  <section class='comments' aria-labelledby="comment">
    <h2 id="comment">Comments</h2>
    <Disqus 
        :pageConfig="pageConfig"
        shortname="chobiDisqus" />
  </section>
</template>

<script>
import { Disqus } from 'vue-disqus'

export default {
    name: 'PostPage',
    props: ['purl'],
  data() {
      return {
          pageConfig: {
                identifier:this.purl,
                title: 'chobi image'
            }
      }
  },
  components: {
    Disqus
  },
  methods: {
    
  },
  created() {
      
  }
  
}
</script>
