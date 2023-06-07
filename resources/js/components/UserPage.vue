<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body user-select-none">
                        <div class="d-flex justify-content-between mb-5">
                            <button class="btn btn-info btn-lg" @click="copyLink">Copy</button>
                            <button class="btn btn-warning btn-sm">Regenerate link</button>
                            <button class="btn btn-link btn-sm" @click="deactivateLink">Deactivate link</button>

                        </div>

                        <div class="d-flex justify-content-center mb-5">
                            <button :class="{disabled: loading}" :disabled="loading" class="btn btn-success btn-lg"
                                    type="button" @click="play">I`m feeling lucky
                            </button>
                        </div>

                        <div v-if="number" class="text-center">
                            <h2 :class="{'text-success': message === 'win', 'text-danger': message === 'lose'}"
                                class="font-monospace">Are you
                                {{ message }}</h2>
                            <p class="text-muted">number</p>
                            <h4>{{ number }}</h4>
                            <template v-if="message === 'win'">
                                <div class="mb-3"></div>
                                <p class="text-dark"><b>your money</b></p>
                                <h1><u>${{ sum }}</u></h1>
                            </template>
                        </div>
                        <div>
                            <div v-if="!games.length">
                                <button class="btn btn-link" type="button" @click="history">History</button>
                                <input v-model="limit" class="bg-transparent border-0 border-bottom" type="text">
                            </div>
                            <ul>
                                <li v-for="game in games" :class="[ game.sum ? 'text-success' : 'text-muted' ]">
                                    <span><b>Are you {{ game.message }}</b></span> <span
                                    v-if="game.sum">(<b>${{ game.sum }}</b>)</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        number: 0,
        message: '',
        sum: 0,
        loading: false,
        loadingHistory: false,
        userId: null,
        games: [],
        limit: 3
    }),
    beforeMount() {
        this.userId = +(new URLSearchParams(location.href).get('user'))
    },
    methods: {
        copyLink() {
            navigator.clipboard.writeText(window.location.href)
            console.log('success')
        },
        async play() {
            this.games = []
            this.loading = true

            const res = await fetch(`/api/play/${this.userId}`)
            const {number, message, sum} = await res.json()

            this.number = number
            this.message = message
            this.sum = sum

            this.loading = false
        },
        async history() {
            this.number = 0
            this.loadingHistory = true
            const res = await fetch(`/api/history/${this.userId}?limit=${this.limit}`)
            this.games = await res.json()

            this.loadingHistory = false
        },
        async deactivateLink() {
            await fetch(`/api/deactivate-link/${this.userId}`)

            alert('User link deactivated');

            setTimeout(() => {
                window.location.reload()
            }, 1000)
        }
    }
}
</script>
