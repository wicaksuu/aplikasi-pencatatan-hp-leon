import Chart from 'chart.js/auto';
import Swal from 'sweetalert2';
import '@fontsource/outfit/300.css';
import '@fontsource/outfit/400.css';
import '@fontsource/outfit/500.css';
import '@fontsource/outfit/600.css';
import '@fontsource/outfit/700.css';

window.Chart = Chart;
window.Swal = Swal;

document.addEventListener('livewire:initialized', () => {
    Livewire.on('swal:confirm', (data) => {
        let details = data[0];
        Swal.fire({
            title: details.title,
            text: details.text,
            icon: details.type,
            showCancelButton: true,
            confirmButtonText: details.confirmText || 'Ya, Lanjutkan',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#8b5cf6',
            cancelButtonColor: '#ef4444',
            background: 'rgba(15, 23, 42, 0.9)',
            color: '#f8fafc',
            backdrop: 'rgba(0, 0, 0, 0.6)',
            customClass: {
                popup: 'border border-white/10 backdrop-blur-xl rounded-2xl shadow-2xl',
                confirmButton: 'rounded-xl px-6 py-2.5 font-semibold transition-all hover:scale-105',
                cancelButton: 'rounded-xl px-6 py-2.5 font-semibold transition-all hover:scale-105',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch(details.method, { id: details.id });
            }
        });
    });

    Livewire.on('swal:prompt', (data) => {
        let details = data[0];
        Swal.fire({
            title: details.title,
            text: details.text,
            input: 'text',
            icon: details.type,
            showCancelButton: true,
            confirmButtonText: details.confirmText || 'Simpan',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#8b5cf6',
            cancelButtonColor: '#ef4444',
            background: 'rgba(15, 23, 42, 0.9)',
            color: '#f8fafc',
            backdrop: 'rgba(0, 0, 0, 0.6)',
            inputValidator: (value) => {
                if (!value) {
                    return "Input tidak boleh kosong!";
                }
            },
            customClass: {
                popup: 'border border-white/10 backdrop-blur-xl rounded-2xl shadow-2xl',
                confirmButton: 'rounded-xl px-6 py-2.5 font-semibold transition-all hover:scale-105',
                cancelButton: 'rounded-xl px-6 py-2.5 font-semibold transition-all hover:scale-105',
                input: 'bg-black/20 border border-white/10 rounded-xl text-white focus:ring-2 focus:ring-violet-500 mt-4'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch(details.method, { value: result.value });
            }
        });
    });

    Livewire.on('swal:toast', (data) => {
        let details = data[0];
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: 'rgba(15, 23, 42, 0.9)',
            color: '#f8fafc',
            customClass: {
                popup: 'border border-white/10 backdrop-blur-xl rounded-xl shadow-lg mt-16 mr-4',
            }
        });
        Toast.fire({
            icon: details.type,
            title: details.title
        });
    });
});
