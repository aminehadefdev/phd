<script>

import "../../styles/Nav.css"
import SideBar from "./SideBar.vue"

export default {
    data() {
        return {};
    },
    methods: {},
    components: { SideBar }
}
</script>

<template>
    <div class="collapse" id="navbarToggleExternalContent">
        <div class="bg-dark p-4">
            <h5 class="text-white h4">Collapsed content</h5>
            <span class="text-muted">Toggleable via the navbar brand.</span>
        </div>
    </div>
    <nav class="navbar navbar-dark bg-dark Nav">
        <div class="container-fluid">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="my-2 my-lg-0 wrapperProf">
                <img src="../../images/vectors/Chat_bubble.svg" alt="" />
                <img src="../../images/vectors/Notification.svg" alt="" />
                <img src="../../images/Profile_picture.png" alt="">


                <button id="btnProf" class="" type="button" data-bs-toggle="collapse" data-bs-target="'#prof"
                    aria-expanded="false" aria-controls="collapseTwo">
                    <div class="">
                        <span>Jane Doe</span>
                    </div>
                    <svg width="13" height="8" viewBox="0 0 13 8" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.3534 0.896555C12.1579 0.701067 11.8419 0.701067 11.6464 0.896555L6.49999 6.04295L1.35359 0.896555C1.15811 0.701067 0.842104 0.701067 0.646616 0.896555C0.451128 1.09204 0.451128 1.40804 0.646616 1.60353L6.14651 7.10343C6.24401 7.20092 6.372 7.24993 6.50001 7.24993C6.62802 7.24993 6.75601 7.20092 6.85351 7.10343L12.3534 1.60353C12.5489 1.40804 12.5489 1.09204 12.3534 0.896555Z"/>
                    </svg>
                </button>
            </div>
        </div>
    </nav>
    <SideBar></SideBar>
</template>