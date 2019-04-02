//function that return the correct prefix base on the browser to set the linear-gradient
function getCssValuePrefix()
{
    var rtrnVal = '';//default to standard syntax
    var prefixes = ['-o-', '-ms-', '-moz-', '-webkit-'];

    // Creating a temporary DOM object for testing
    var dom = document.createElement('div');

    for (var i = 0; i < prefixes.length; i++)
    {
        // Attempt to set the style
        dom.style.background = prefixes[i] + 'linear-gradient(#000000, #ffffff)';

        // Detect if the style was successfully set
        if (dom.style.background)
            rtrnVal = prefixes[i];
    }

    dom = null;
    delete dom;

    return rtrnVal;
}

//function that generate the random rgba color
function getRandomColor(){
	var r = Math.floor(Math.random()*256);
	var g = Math.floor(Math.random()*256);
	var b = Math.floor(Math.random()*256);
	var a = 0.6;
	return `rgba(${r}, ${g}, ${b}, ${a})`;
}

//to generate random linear gradient
function getRandomLinearGradient(){
	return getCssValuePrefix() + 'linear-gradient(' + getRandomColor() + ', ' + getRandomColor() + ')';
}

window.addEventListener('load',function(){
	if(document.title=="Registration" || document.title=="Login"){
		document.querySelector('.login-box').style.backgroundImage = getRandomLinearGradient();
	}
	else{
		//getting the cards available and setting randomly generated linear-gradient to it(the cards).
		var cardArr = document.getElementsByClassName('card');
		for(var i = 0 ; i < cardArr.length ; i++)
			cardArr[i].style.backgroundImage = getRandomLinearGradient();

		//setting random background image
		document.body.style.backgroundImage = "linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)),url('img/bg-" + Math.floor(Math.random()*5 + 1) + ".jpg')";		
	}
});
