<div
    x-data="{
        show: false,
        message: '',
        type: 'success'
    }"

    x-on:toast.window="
        show = true;
        message = $event.detail.message;
        type = $event.detail.type ?? 'success';

        setTimeout(() => show = false, 3000);
    "
>
    <div
        x-show="show"
        x-transition
        class="fixed top-4 right-4 z-50"
    >
        <div class="rounded-lg bg-black text-white px-4 py-3">
            <span x-text="message"></span>
        </div>
    </div>
</div>