<script>
import "../../styles/AddEvent.css"
import axios from "axios";


export default {
    data() {
        return {
            event: {
                "title": null,
                "organizer": null,
                "type": null,
                "image": "c",
                "file": null,
                "date": null,
                "locality": null
            },
        };
    },
    methods: {
        createEvent() {
            var onThen = (response)=>{
                console.log(response.data[0]);
                    this.addInContenerCard(response.data[0])
            }
            var onCatch = (error)=>{
                console.log(error);
            }
            try {
                var data = new FormData();
                data.append("image", this.event.file[0]);
                data.append("title", this.event.title);
                data.append("organizer", this.event.organizer);
                data.append("type", this.event.type);
                data.append("locality", this.event.locality);
                data.append("date", this.event.date);
                data.append("image", this.event.file[0].name);

                axios.post("http://localhost:8000/event", data)
                .then(onThen)
                .catch(onCatch)
            } catch (error) {
                console.log(error.message);
            }
        }
    },
    components: {},
    props: {
        addInContenerCard: Function
    }
}
</script>

<template>
    <div class="wrapperAddEvent">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">add event +</button>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create new event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="InputTitle">Title</label>
                            <input :value="event.title" @input="e => event.title = e.target.value" type="text"
                                class="form-control" id="InputTitle" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label for="InputOrganizer">Organizer</label>
                            <input :value="event.organizer" @input="e => event.organizer = e.target.value" type="text"
                                class="form-control" id="InputOrganizer" placeholder="Organizer">
                        </div>
                        <div class="form-group">
                            <label for="InputType">Type</label>
                            <input :value="event.type" @input="e => event.type = e.target.value" type="text"
                                class="form-control" id="InputType" placeholder="Type">
                        </div>
                        <div class="form-group">
                            <label for="formFile" class="form-label">image</label>
                            <input  @input="(e) => {
                                        event.file = e.target.files
                                        event.image = e.target.files[0].name
                                    }"
                                class="form-control"
                                type="file" id="formFile">
                        </div>
                        <div class="form-group">
                            <label for="InputDate">Date</label>
                            <input :value="event.date" @input="e => event.date = e.target.value" type="text"
                                class="form-control" id="InputDate" placeholder="2022-12-20">
                        </div>
                        <div class="form-group">
                            <label for="InputLocality">Locality</label>
                            <input :value="event.locality" @input="e => event.locality = e.target.value" type="text"
                                class="form-control" id="InputLocality" placeholder="Paris">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button data-bs-dismiss="modal" @click="createEvent" type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </div>
</template>