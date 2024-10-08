$(document).ready(function () {
    console.log('asdf');
    fetchNumbers(); // Call to fetch the initial numbers when the document is ready
});

window.fetchNumbers = async function () {
    try {
        // Make the AJAX call to fetch ticket numbers
        const res = await ajax(`/fetch_numbers/`);
        
        // Check if the response is successful
        if (res && res.data) {
            // Assuming the response contains the counts in the data property
            const { pending, approved, denied, expired } = res.data;

            // Update the DOM elements with the fetched numbers
            $('#PendingNumbers').text(pending); // Update Pending numbers
            $('#ApprovedNumbers').text(approved); // Update Approved numbers
            $('#DeniedNumbers').text(denied); // Update Denied numbers
            $('#ExpiredNumbers').text(expired); // Update Expired numbers
        }
    } catch (error) {
        console.error('AJAX request failed:', error);
        alert('An error occurred while fetching tickets data.');
    }
}
