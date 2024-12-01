function setujui(studentId) {
    if (confirm("Apakah Anda yakin ingin menyetujui?")) {
        fetch(`/kaprodi/irs/setujui/${studentId}`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                alert(data.message);
                location.reload(); // Reload halaman setelah update
            })
            .catch((error) => console.error("Error:", error));
    }
}

function tolak(studentId) {
    if (confirm("Apakah Anda yakin ingin menolak?")) {
        fetch(`/kaprodi/irs/tolak/${studentId}`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                alert(data.message);
                location.reload(); // Reload halaman setelah update
            })
            .catch((error) => console.error("Error:", error));
    }
}
