document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.change-status');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const tr = this.closest('tr');
            const appointmentId = tr.getAttribute('data-id');
            const newStatus = this.getAttribute('data-status');

            fetch(`/appointments/${appointmentId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ appointment_status: newStatus })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Request failed');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    const statusCell = tr.querySelector('.status');
                    statusCell.textContent = data.new_status.charAt(0).toUpperCase() + data.new_status.slice(1);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Something went wrong.");
            });
        });
    });
});