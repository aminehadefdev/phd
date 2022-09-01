<script>

import "../../styles/ItemSideBare.css"

export default {
    data() {
        if (this.options) {
            console.log(this.options[0].configOption.html)
        }
        return {}
    },
    methods: {
        actv: function (e) {
            //e.preventDefault()
            Array.from(document.getElementsByClassName("actv")).map((item) => {
                item.classList.remove("actv")
            })
            let curentElemnt = document.getElementById(this.item.id)
            curentElemnt.firstChild.children[1].classList.add('actv')
            curentElemnt.classList.add('actv')
        }
    },
    props: {
        //name: String,
        //id: String,
        //svg: String,
        //cls: String,
        //options: Array,
        //href: String

        item: Object
    }
}
</script>

<template>

    <div class="ItemLinkBar" v-if="item.options !== undefined">
        <div class="accordion-item">
            <button class="ButtonLink" type="button" data-bs-toggle="collapse" v-bind:data-bs-target="'#' + item.id"
                aria-expanded="false" aria-controls="collapseTwo">
                <div class="wrapperImgSpanItemOption">
                    <span class="span" v-html="item.svg"></span>
                    <span>{{ item.name }}</span>
                </div>

                <img src="../../images/vectors/arrowBottom.svg" alt="icone profile" />
            </button>
            <div v-bind:id="item.id" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <ul class="wrapperOptionsItemBar">
                        <li v-for="option in item.options">
                            <div class="ItemLinkBar">
                                <div class="accordion-item">
                                    <router-link :to="'/' + option.configOption.href" :id="option.configOption.id" @click="actv" :class="'ButtonLink ' + option.configOption.cls">
                                        <div class="wrapperImgSpanItemOption">
                                            <span :id="'obj-' + option.configOption.id" class="span" v-html="option.configOption.svg"></span>
                                            <span :class="option.configOption.cls">{{ option.configOption.name }}</span>
                                        </div>
                                    </router-link>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="ItemLinkBar" v-else-if="item.options === undefined">
        <div class="accordion-item">
            <router-link :to="'/' + item.href" :id="item.id"  @click="actv" :class="'ButtonLink ' + item.cls">
                <div class="wrapperImgSpanItemOption">
                    <span :id="'obj-' + item.id" class="span" v-html="item.svg"></span>
                    <span :class="item.cls">{{ item.name }}</span>
                </div>
            </router-link>
        </div>
    </div>





</template>