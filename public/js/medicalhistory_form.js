document.addEventListener('DOMContentLoaded', function () {
    const treatmentSelect = document.getElementById('treatment');
    const procedurSelect = document.getElementById('Procedur');

    if (!treatmentSelect || !procedurSelect) {
        console.warn('Element #treatment or #Procedur not found in DOM.');
        return;
    }

    function loadProcedures(treatmentId, selectedValue = '') {
        procedurSelect.innerHTML = '<option value="">Loading...</option>';

        if (!treatmentId) {
            procedurSelect.innerHTML = '<option value="">Select treatment first...</option>';
            return;
        }

        fetch(`/treatments/${treatmentId}/procedures`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok. Status: ' + response.status);
            return response.json();
        })
        .then(data => {
            procedurSelect.innerHTML = '<option value="">Select...</option>';

            if (Array.isArray(data)) {
                data.forEach(proc => {
                    const opt = document.createElement('option');
                    opt.value = proc ?? '';
                    opt.textContent = proc ?? '';
                    if (proc === selectedValue) {
                        opt.selected = true;
                    }
                    procedurSelect.appendChild(opt);
                });
            } else if (data) {
                const opt = document.createElement('option');
                opt.value = data;
                opt.textContent = data;
                if (data === selectedValue) {
                    opt.selected = true;
                }
                procedurSelect.appendChild(opt);
            }
        })
        .catch(err => {
            console.error('Error fetching procedures:', err);
            procedurSelect.innerHTML = '<option value="">Error loading</option>';
        });
    }

    // عند تغيير اختيار الـ treatment
    treatmentSelect.addEventListener('change', function () {
        loadProcedures(this.value);
    });

    // تحميل القيم تلقائيًا إذا رجعنا بعد validation error
    const oldTreatmentId = treatmentSelect.value; // Laravel old('treatment_id') سيضعه هنا تلقائياً
    const oldProcedure = procedurSelect.getAttribute('data-old'); // نمرر old('procedure_Summary') في Blade
    if (oldTreatmentId) {
        loadProcedures(oldTreatmentId, oldProcedure);
    }
});