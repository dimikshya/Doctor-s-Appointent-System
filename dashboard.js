document.addEventListener('DOMContentLoaded', () => {
    const doctorCountElem = document.getElementById('doctor-count');
    const patientCountElem = document.getElementById('patient-count');
    const appointmentCountElem = document.getElementById('appointment-count');
    const revenueElem = document.getElementById('revenue');
    const doctorsTableBody = document.getElementById('doctors-table').getElementsByTagName('tbody')[0];
    const appointmentsTableBody = document.getElementById('appointments-table').getElementsByTagName('tbody')[0];
    function fetchData() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'getData.php', true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                doctorCountElem.textContent = data.summary.doctors;
                patientCountElem.textContent = data.summary.patients;
                appointmentCountElem.textContent = data.summary.appointments;
                revenueElem.textContent = data.summary.revenue;
                doctorsTableBody.innerHTML = '';
                appointmentsTableBody.innerHTML = '';
                data.doctorsList.forEach(doctor => {
                    const row = doctorsTableBody.insertRow();
                    row.innerHTML = `
                        <td>${doctor.name}</td>
                        <td>${doctor.revenue}</td>
                        <td>${'★'.repeat(Math.floor(doctor.rating))}${'☆'.repeat(5 - Math.floor(doctor.rating))}</td>
                    `;
                });
                data.appointmentsList.forEach(appointment => {
                    const row = appointmentsTableBody.insertRow();
                    row.innerHTML = `
                        <td>${appointment.doctor_name}</td>
                        <td>${appointment.patient_name}</td>
                        <td>${new Date(appointment.appointment_time).toLocaleString()}</td>
                        <td>${appointment.amount}</td>
                    `;
                });
            } else {
                console.error('Error fetching data:', xhr.statusText);
            }
        };
        xhr.onerror = function () {
            console.error('Request failed');
        };
        xhr.send();
    }
});
