<template>
    <div>
        <h1 class="font-weight-bold"></h1>
        
        <div class="container mt-3">
            <h2>{{ article.title }}</h2>
            <div class="card">
                <div style="" class="d-flex justify-content-center p-2">
                    <img class="w-50" src="https://www.ostrovbali.net/wp-content/uploads/2019/03/%D0%BF%D1%80%D0%B0%D0%B7%D0%B4%D0%BD%D0%B8%D0%BA%D0%B8-%D0%BD%D0%B0-%D0%B1%D0%B0%D0%BB%D0%B8.jpg" alt="">
                </div>
                <div class="card-body">
                   <p>{{ article.body }}
                    </p>  
                </div>
            </div>
            <button @click.prevent="backHome" class="btn btn-primary">Back</button>
        </div>
    </div>
</template>

<script>


export default ({
    props: ['article_id'],

    data() {
        return {
            article: {}
        }
    },
    created() {
        console.log("test loaded", this.article_id)
        this.fetchArticle(this.article_id)
    },

    methods: {
         async fetchArticle(articleId) {
            let config = {
                method: "get",
                url: `${window.location.origin}/api/articles/${articleId}`,
            }
             
            await axios(config).then((response) => {
                this.article = response.data
            }).catch((error) => {
                console.log(error)
            })
        },  

        backHome() {
            window.location = window.location.origin
        }
    }
})
</script>
