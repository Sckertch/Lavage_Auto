<template>
    <div class="prestation--card">
        <div class="prestation--image" :style="{ backgroundImage: `url(${prestation.link})` }">
            
        </div>
        <div class="prestation--info">
            <div class="titles">
                <h2>{{ prestation.nom }}</h2>
            </div>
            <div class="carac">
                <p>{{ prestation.caractéristiques }}</p>
            </div>
            <div class="prix">
                <p>{{ prestation.prix }} €</p>
            </div>
        </div>


    </div>
</template>

<script>
export default {
    name:"ListePrestation",
    props: {
        prestation: {
            type: Object,
            required: true
        }
    }

};
</script>

<style lang="scss">
    .prestation--card{
        font-family:cursive;
        display: flex;
        flex-direction: row;
        width: 70%;
        height: 275px;
        background-color: #a9ce55;
        background-attachment: fixed;
        background-position: center;
        margin-top: 10px;
        margin-bottom: 10px;
        border: 5px solid #57b55c;

        .prestation--image{
            width: 250px;
            position: relative;
            background-size: cover;
        }

        .prestation--info{
            width: 70%;
            position: relative;
            display: flex;
            flex-direction: column;
            position: relative;

            .titles{
                text-align: center;
                h2{
                margin-top: 5px;

                }
            }

            .carac{
                margin: 2%;

            }

            .prix{
                position: absolute;
                bottom: 0;
                right: 0;
                margin-right: 5px;
                margin-bottom: 5px;
                border: 2px solid #57b55c;
                text-align: center;
                margin-top: 10%;
                background-color: #57b55c;
                color: #ffffff;

                p {
                    padding-left: 10px;
                    padding-right: 10px;
                    color: #000000;
                }
            }
        }
    }
</style>
  