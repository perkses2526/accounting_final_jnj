$(document).ready(function () {
    fetchNumbers(); 
});

window.fetchNumbers = async function () {
    try {
        const res = await ajax(`/fetch_numbers/`);
        
        if (res && res.data) {
            const { pending, approved, denied, expired } = res.data;

            $('#PendingNumbers').text(pending);
            $('#ApprovedNumbers').text(approved); 
            $('#DeniedNumbers').text(denied);
            $('#ExpiredNumbers').text(expired); 
        }
    } catch (error) {
        console.error('AJAX request failed:', error);
        alert('An error occurred while fetching tickets data.');
    }
}
