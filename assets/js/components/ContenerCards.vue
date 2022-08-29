<script>

import "../../styles/ContenerCards.css"
import Card from "./Card.vue";
import AddEvent from './AddEvent.vue'
import Request from "../utiles/Request.js"

export default {
    data() {
        return {
            events: null,
        }
    },
    async created() {
        this.events = (await Request.getEvents());
    },
    methods: {
        creatCard(event){
            this.events.push(event);
        }
    },
    components: { Card, AddEvent, Card }
}
</script>

<template>
    <div class="row CardContainer container w-75">
        <AddEvent :addInContenerCard="creatCard"></AddEvent>
        <div v-if="events === null">loading events...</div>
        <Card v-else v-for="event in events" :event="event"></Card>
    </div>

</template>