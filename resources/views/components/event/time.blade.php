<script>
    const startTimeInput = document.querySelector('select[name="start_time"]');
    const endTimeInput = document.querySelector('select[name="end_time"]');

    startTimeInput.addEventListener('change', () => {
        const startTime = startTimeInput.value;
        endTimeInput.innerHTML = '';
        for (let i = parseInt(startTime) + 1; i <= 23; i++) {
            const hour = String(i).padStart(2, '0');
            endTimeInput.innerHTML += `<option value="${hour}:00:00">${hour}:00</option>`;
        }
    });

    const form = document.querySelector('form');

    form.addEventListener('submit', (event) => {
        const startTime = startTimeInput.value;
        const endTime = endTimeInput.value;

        if (startTime >= endTime) {
            event.preventDefault();
            alert("L'heure de début doit être inférieure à l'heure de fin.");
        }
    });
</script>
