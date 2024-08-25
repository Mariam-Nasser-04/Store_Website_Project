// Get the section element by its ID
var mySection = document.getElementById("container");

// Array of background images
var backgroundImages = [
    "background/B2.jpg","background/B5.jpg","background/B3.jpg","background/B4.jpg","background/B1.jpg"
];
var i=0;
// Function to change the background image
function changeBackgroundImage() {
    // Generate a random index to select a random background image
   // var randomIndex = Math.floor(Math.random() * backgroundImages.length);
    
    // Construct the URL for the selected background image
    var imageUrl = 'url(' + backgroundImages[i] + ')';
    i++;
    // Set the background image of the section
    mySection.style.backgroundImage = imageUrl;
    if(i==backgroundImages.length){
        i=0;
    }
}

// Set interval to change background image every 5 seconds (5000 milliseconds)
setInterval(changeBackgroundImage, 5000);

function show(char){
    document.getElementById('char').style.visibility='visible';
    // document.getElementById('char').style.animation.;
}
