<template>
    <div>
        <form @submit="formSubmit">
        
<button v-if="show" type="submit" class="btn btn-success btn-m" style="width: 100%">Participate</button>   
<button v-else type="submit" class="alert alert-success btn-m" style="width: 100%" disabled> Participated Successfully! </button>
        </form>
    </div>
</template>

<script>

    export default {
        props:["eventid"],
        mounted() {
            console.log('Component mounted.')
        },
        data()
            {
            return{
                'show':true
            }
        },
        methods:

        {
             formSubmit(e)
             {
                  e.preventDefault();
                  axios.post('/participations/'+ this.eventid,{}).then((response)=>{this.show=false});
             }
        }

    }
</script>
