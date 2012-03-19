/** 
 * As3GameGears Tooltip
 * http://as3gamegears.com/extras/
 * 
 * Copyright (C) 2012 Fernando Bevilacqua
 * 
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 */
$(function() {
	$("[rel=as3gamegears]").each(function(index) {
		var aTarget = $(this);
		var aItem 	= aTarget.data('agg-item') == null ? aTarget.html() : aTarget.data('agg-item');

		aTarget.popover({title: "", trigger: "manual", content: function() {return "Loading..."} });
	    
		aTarget.hover(
			function () {
				// Fadeout any active tooltip then show
				// the current hover'd tooltip.
				$(".as3gg-popover").fadeOut();
				aTarget.popover('show');

				// While we load the content, display a loading message.
				$(".as3gg-popover").find("h3").html('Loading');
				$(".as3gg-popover").find("p").html('<img title="Loading..." src="data:image/gif;base64,R0lGODlhEAALAPQAAP///wAAANra2tDQ0Orq6gYGBgAAAC4uLoKCgmBgYLq6uiIiIkpKSoqKimRkZL6+viYmJgQEBE5OTubm5tjY2PT09Dg4ONzc3PLy8ra2tqCgoMrKyu7u7gAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh/hpDcmVhdGVkIHdpdGggYWpheGxvYWQuaW5mbwAh+QQJCwAAACwAAAAAEAALAAAFLSAgjmRpnqSgCuLKAq5AEIM4zDVw03ve27ifDgfkEYe04kDIDC5zrtYKRa2WQgAh+QQJCwAAACwAAAAAEAALAAAFJGBhGAVgnqhpHIeRvsDawqns0qeN5+y967tYLyicBYE7EYkYAgAh+QQJCwAAACwAAAAAEAALAAAFNiAgjothLOOIJAkiGgxjpGKiKMkbz7SN6zIawJcDwIK9W/HISxGBzdHTuBNOmcJVCyoUlk7CEAAh+QQJCwAAACwAAAAAEAALAAAFNSAgjqQIRRFUAo3jNGIkSdHqPI8Tz3V55zuaDacDyIQ+YrBH+hWPzJFzOQQaeavWi7oqnVIhACH5BAkLAAAALAAAAAAQAAsAAAUyICCOZGme1rJY5kRRk7hI0mJSVUXJtF3iOl7tltsBZsNfUegjAY3I5sgFY55KqdX1GgIAIfkECQsAAAAsAAAAABAACwAABTcgII5kaZ4kcV2EqLJipmnZhWGXaOOitm2aXQ4g7P2Ct2ER4AMul00kj5g0Al8tADY2y6C+4FIIACH5BAkLAAAALAAAAAAQAAsAAAUvICCOZGme5ERRk6iy7qpyHCVStA3gNa/7txxwlwv2isSacYUc+l4tADQGQ1mvpBAAIfkECQsAAAAsAAAAABAACwAABS8gII5kaZ7kRFGTqLLuqnIcJVK0DeA1r/u3HHCXC/aKxJpxhRz6Xi0ANAZDWa+kEAA7AAAAAAAAAAAA" />');
				
	        	$.ajax({
	    			url: "http://api-dev.as3gamegears.com/1.0/item/" + aItem,
	    			context: document.body,		    		    
	    			success: function(data){
	    				var aContent = '', aLicenses = '';
	    				
	    				aContent += '<div class="as3gg-sideinfo">';
	    				aContent += '<p>'+data.excerpt+'</p>';
						
	    				aContent += '<img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEASABIAAD/2wBDAAYEBAQFBAYFBQYJBgUGCQsIBgYICwwKCgsKCgwQDAwMDAwMEAwODxAPDgwTExQUExMcGxsbHCAgICAgICAgICD/2wBDAQcHBw0MDRgQEBgaFREVGiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICD/wAARCAAoADIDAREAAhEBAxEB/8QAHAAAAgIDAQEAAAAAAAAAAAAAAAcDCAEEBQIG/8QALRAAAQQBAwMDAgYDAAAAAAAAAQIDBAURAAYSBxMhFCIxFUEIFiMyM1FDYYH/xAAUAQEAAAAAAAAAAAAAAAAAAAAA/8QAFBEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEQMRAD8AtToNedPiQY635K+LbaFuEAFayltPJXFCApaiAPhIJ0CZR+IKv3rLfoNhyfRXSZCWmF2EVxXqGx/IWg2VFjz4C3kYH3xoN1XWV/ZbNTTbzYdlXli4lqC3ET3Mslzth1+QT2CsD9yULWfGTjOgadNcRLaA3NjJdQ05y4pfbWyv2nB9qwDj/fxoN7QGgNBTG82hvKR1EtJ3UK6s1tbbgTLQWcPilx5uJIbRxrhyQiMrD6MnHg/34Og6lfv613nIn0Lm236aplssrn7mrZSI1g3Ga/T71pYPBDUpJ/yIUUZx4OdBmmno2Ht+Q/tR9PUenLhXYBBDlfWBK8ocNYS7I7hCQTIOE4/vQSs9UmLeut+o1OJ1XYx3Pp91XvyHZTUhLrDzrBiPDiGex23CAW+IzoLQbWjOxtvV7Tsl+Y4GUqMiWrm+rn7v1FDGSM40HU0BoK+70+vKf3H+bKpT1Z+WrUquYvD1CWPWjgw27lTeVISF8FA4OPjzoFTuDaryehLztHaO7gqk3aZq/TsupU0yInHhKZyvtdtXk/Kc/B850Hz3QWispm92raE26zCgwLA2U9ZIjM9yC+hvuLSPAJUk8fn74OgZ/Rqsbo6CXWbWK5ls7btxZk+wZU1wdbhvKU7DirSothtKyCt/9ySc8PGgtHAQW4UdBWXCltILhOSo4+cjx50E+gNAnN1125aKHvqVZRGpe0/pM6TFg9xZjvqK1vKQ6ElDjSuC+OUfP9/bQK6hejW3R913pzImxbAWrq2KqVLQiciT6NP6MF8FHqMABYGApQyME6CLp2nqFbTJu493d+q2jWV9g2GDGRFw8YbqH3IsRCGe48kqUVr4jz4J+2gcs6gnbir0VUKOWIcmW0bZ31GS7FLLTnJ5TZHu4nilA8f8GgaaUhKQkfAGBoM6A0Hlxtt1tTbiQttYKVoUMgg/IIPzoFdvvoZSWe0Z9Ntppqq9Q+5PEVA4MqldngjiU/xDkAfHjQcHo/0r3kmO/M33LlOuLbfhpakyXHpK2nEdhXNzPtRxHswc/f76B1w4cWHFaixWksx2UhDTSBgJSkYAGgm0BoP/2Q=="/>';
	    				aContent += '<p>';
	    				
	    				for(var i = 0; i < data.license.length; i++) {
	    					aLicenses += '<strong><a href="http://www.as3gamegears.com/tag/'+data.license[i].slug+'/">'+data.license[i].name+'</a></strong>, ';
	    				}
	    				aLicenses = aLicenses.substring(0, aLicenses.length - 2);
	    				aContent += aLicenses + '<br/>License</p>';
						
	    				if(data.site != '') {
		    				aContent += '<img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEASABIAAD/2wBDAAYEBAQFBAYFBQYJBgUGCQsIBgYICwwKCgsKCgwQDAwMDAwMEAwODxAPDgwTExQUExMcGxsbHCAgICAgICAgICD/2wBDAQcHBw0MDRgQEBgaFREVGiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICD/wAARCAAoADIDAREAAhEBAxEB/8QAGwAAAgIDAQAAAAAAAAAAAAAAAAYFBwIDBAj/xAAvEAABBAAGAAYABQUBAAAAAAABAgMEBQAGBxESExQhIjFBYRUXMlGxFiMzNFKB/8QAFAEBAAAAAAAAAAAAAAAAAAAAAP/EABQRAQAAAAAAAAAAAAAAAAAAAAD/2gAMAwEAAhEDEQA/APVOA47i4q6atkWdrKbhV8VPORJeVxQlP2f4HzgK3RrDf3t5EqMn5Ydd8U2ZQsLZfg2xDCuAk9GynuDivJvnxKvgbeeA2NapZhhU9PZ2ECNatXTyo0VqsV0vKebUsLS2l9xbTh4tkpT2hSvjAOuU84Uuaa1U6rU6npcLEuLJaWxIYeR+pp5pYCkqG+Am8AYAwFU58yhqLmfO8SXGaqnsr0XW7ArrRb/VJmK35yHEMg7ljYJbC/LzKsBAaataxWarnO0MZeU9mOUUh2V47cRoCjGaQ0E+zXoWtIPmSrc4AyFBz/ZaaRFS2KiRSxi9Or1oU/8AiCZEaW46lwcU9PLkk8eJH84B2pLnOF9UV+Zqv8OTXWEeNMJQh7xLgJ3daW2d079fpHr9Kv3GAfx5jAGAMAq3rOozLb6Muqq3EbAsLsjJ7NyFFzl1eXvtx2+MBX2kCdXPyvoPwhWXxE8MfDolJm9v6z/kKDty5b77DAc2jw1gOmdMKQZeFaUyesTvGl7fxTu/Lq2Ttvvt9YCT0Qj6lwtP6xieirRTMtPdSFeLamhIec3DgUOI+v2GAtqDIbkRG3m1BaFjdKk77Ef+4DfgDAV3mTM+dKHPrENa4v8ATV63wrJkltzrjTmm/wDXdcbPpD59SSofBA88As6Y/mrVw7nJrCKVuZl6Uvr7/Gdamp5MppbZHu1ycUgfI47HARmnV/qVV6R19hGbp1Vh7GYDDQkmYp1yWprYJJ6ieZUR9YB9FzeMXjOS++BJddZVyTHU+ZLERKEjuknzCCvc8f8Ao+2AfWmkNNIabGyEAJSPoYDPAGA0TYMOdFciTGUSIzo2cZcHJJ89/MH7GASoWms6ltXbWkvJLj3StmNDsld7SUqUpxLRdADpbSs+kKKuA9sBHZD07zpV0sGsurCAyzV8zARWtqc4uOrLinSqQlI5jmQPR7feAe6rLtLUvzZMCI2zKsXO+wkgf3X3Ntgpxfudh7D4wElgDAf/2Q=="/>';
		    				aContent += '<p><strong><a href="'+data.site+'" target="_blank">'+data.site+'</a></strong><br/>Website</p>';
	    				}
						
	    				if(data.twitter != '') {
		    				aContent += '<img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEASABIAAD/2wBDAAYEBAQFBAYFBQYJBgUGCQsIBgYICwwKCgsKCgwQDAwMDAwMEAwODxAPDgwTExQUExMcGxsbHCAgICAgICAgICD/2wBDAQcHBw0MDRgQEBgaFREVGiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICD/wAARCAAoADIDAREAAhEBAxEB/8QAGwAAAgIDAQAAAAAAAAAAAAAABwgABAEFBgP/xAAuEAABAwMDAwMCBgMAAAAAAAACAQMEBQYRABIhBxMxCBQiMkEVFiNCUXEzYZH/xAAUAQEAAAAAAAAAAAAAAAAAAAAA/8QAFBEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEQMRAD8AanQCzq51/t/p08xFchnVJrqr3GW3O0jaYzyW0+V/jGg42merUqiyLzNoOi0riArhy1ENp/SoksZEIl5+KaDbS/VLbgstxoNNKdcDrqNtUkHlHuCp7EJuQrXbVcc7dBtbb9QUGroUyTQpVMojJdmTUpBjgHyNAENm0dyc53CuNAWUVFTKcovhdBnQTQI/1/tC4IfVV2ZXmVl06dUG1hyGxLtezkOmQsG55Qx5Tb/zQM71msWTcHS6ZQLehNrPZ9v+EsptaRrtOhnYS8DhrcmgANtdCuq1MuVusVO2256xyU2HEnNd1DzlCL7H/XHnQe/57qiVas2fUynRArChEqEWeLZOw5L0kWm1iNp8O2gGioiFhM5TQNZQYSwKHToKkZrFjMsqbvLi9ttByfn5LjnQXtBNAsvqSi3FUp7bQNe5h0qpMyQBksK2z2kM3HG8ruwp8LoDp1JvT8l2TUrn9mtQSnCB+1Q+3uQ3Bb+vaeMb8+NAFad6wXqhwxZ6gatqYI5PREMv2gGGMqRfZNBxdt3bWK/1IuS4LljxoUp9lpp6nPNl3o7Uc07bTYOByZEApuX93KaBtaBICTQqdIBtWgeisuC0p9xRQm0Xap/uxnz99Bf0E0CmdVrrqr14XLT6tEkRxcGe3Q5EWO5uMmG+w1g18rxlVHjnQGHpN1Dtnqn0+SBU2hcme3SDXaZIRUQy27SIc43CeMphcpoLEf069JoziHHpBNYIDERkP7UJpciqZPjC6Ac3I5a8Tq5PdI2JT9ONgFdec/XR4WCfFN68oqOEmVHjwn86BhqWmKZETCp+i3wpIa/Snkkwi/3oLWgmg5uv2Db1cnNz5zRHLZEhYNTc2gpY+QghIOcon20A1onpkg06LNiuV9x9mapuGCRkaHuuIXzVEdXON3CcYxoNnafQV23oTsVbhOeB/wCP3Ec1QFXGVx7hc5xoPOo+nG36rex3NVJvdB0t78FhlWd6oKCm53uEuPjzxoC8IiIoIpgU4RP9aDOg/9k="/>';
		    				aContent += '<p><strong><a href="http://twitter.com/'+data.twitter+'" target="_blank">@'+data.twitter+'</a></strong><br/>Twitter</p>';
	    				}

	    				if(data.repository != '') {
		    				aContent += '<img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEASABIAAD/2wBDAAYEBAQFBAYFBQYJBgUGCQsIBgYICwwKCgsKCgwQDAwMDAwMEAwODxAPDgwTExQUExMcGxsbHCAgICAgICAgICD/2wBDAQcHBw0MDRgQEBgaFREVGiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICD/wAARCAAoADIDAREAAhEBAxEB/8QAGwAAAgIDAQAAAAAAAAAAAAAABgcABQMECAH/xAAvEAABBAEDAgMGBwEAAAAAAAACAQMEBQYAERIHIRMUIggjMUFRYRUWJDJicYFy/8QAFAEBAAAAAAAAAAAAAAAAAAAAAP/EABQRAQAAAAAAAAAAAAAAAAAAAAD/2gAMAwEAAhEDEQA/AHfm/UO3pshr8YpaIrG5tmidhSZLwRIHu12MSe9ZKYp34CG6poNIcD6iZAvPMctOJFL40uNisJr/AJOYfOSaL89lHQU1xVp0nyStyCnB38jWCN1mTRiNx/yp8l8tYc3FM9ubnB1VX57/AB0DfEhIUIV3Fe6KnwVNB7oJoJoAjrLSwbPAZ7kmzGkfrFCyrrcy4jGlxV5smq9+yl6dkRV79u+gSi+17azWGa+FUNV9iLYNzbCeSq0MjbYyFkeCoG/f1FoFBlvVjP72S/8Ajt29YNRpfAYjRI1XuAO+4qyzwQv7XfQU1T1NySgsGnquxso8NAFCgJMfAf5cSEtv6VR/zQdC9OvaWjTCjxisUdNdherL1xuPJ3+ZRrIBbjO/Zt8G1+hLoH/j2TVt9CSVD8RvuoEy+PhuIQ7cvqJInJPUCqP0XQW2gBrhnzmRTvzaI/lOJ5Fa2O80KxnJRny5unuSkrboigoooiffQTP+jeA500blpCRmyIeLdvDXwZSfTcx7Gn2NFTQcldaeiEjpoMeWVqFo1OeUYqdmn+DY7kpterfjv3NO3dProNnpb7Nt91BpYd15iLUU7xGhy0PzDznE+KoLArsCpsqLzJPku2g6ApvZR6UV1FLr3Yzs+fMYJlbaSfJ5oiTZHGATZsCFe6enf/NBd9OcZgLTt1NjEbrchxx8mZiVhFGZdLcTCV4bezf6ptAcIdl2Vdl0DK0GGaCHDeBU33Ak2/zQLekxK0WC3d4fffh1u4KLbVT36usekonr8VjkhsOKv7jaIfqqLoBzrHiD8HpFmN7dPhOyafHaSRKFPdR2vHa/SxOXqFlFTfv3Je66DD0+g5XhlPjdhiNP+P4/klTEKxr2HG4/gWYMAnnfEc2RG5Dae8/km/z0BpZvZ+eKK/kk6DQSH5Ai4NeZqjTJkiCCyHOO5r3RVEU+PbQE+K4Xj+LwkiVLJinqUn33XJDxKZcjUnHVIvUXddBeaCaAFybpLT2Vo5f0c2TjGUGiIVtWlxR3imwpKjl7l8U/km/30C962zupcDpHf1eTQWbluQ0Dbd3TgQI2guCZOS47iqoJsP7gVU+2gI+juS5XOwGiroONyILEKviRhtbNRZbcMGkEjajoqum329K9t9Ab12LzXqx2Llk4L9x59H0RWBYZaQFRWwAB3X0Km/JV3XQEWgmg/9k="/>';
		    				aContent += '<p><strong><a href="'+data.repository+'" target=_blank>GitHub</a></strong><br/>Code Repository</p>';
	    				}
						
	    				aContent += '</div>';
	    				
						$('.as3gg-popover h3').html(data.name);
						$('.as3gg-popover p').html(aContent);
						aTarget.popover('show');
						
						$('.as3gg-popover').hover(
							function() { $(this).fadeIn(); },
							function() { $(this).fadeOut(); }
						);
	    			},
	    			error: function() {
	    				// TODO: show loading error
	    			}
	        	}); 
			}, 
			function () {
			});
	});
	
	$('head').append($('<style type="text/css"> .as3gg-popover p { margin: 0 0 9px; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 13px; line-height: 18px; } .as3gg-popover { position: absolute; top: 0; left: 0; z-index: 1010; display: none; padding: 5px; } .as3gg-popover.top { margin-top: -5px; } .as3gg-popover.right { margin-left: 5px; } .as3gg-popover.bottom { margin-top: 5px; } .as3gg-popover.left { margin-left: -5px; } .as3gg-popover.top .arrow { bottom: 0; left: 50%; margin-left: -5px; border-left: 5px solid transparent; border-right: 5px solid transparent; border-top: 5px solid #000000; } .as3gg-popover.right .arrow { top: 50%; left: 0; margin-top: -5px; border-top: 5px solid transparent; border-bottom: 5px solid transparent; border-right: 5px solid #000000; } .as3gg-popover.bottom .arrow { top: 0; left: 50%; margin-left: -5px; border-left: 5px solid transparent; border-right: 5px solid transparent; border-bottom: 5px solid #000000; } .as3gg-popover.left .arrow { top: 50%; right: 0; margin-top: -5px; border-top: 5px solid transparent; border-bottom: 5px solid transparent; border-left: 5px solid #000000; } .as3gg-popover .arrow { position: absolute; width: 0; height: 0; } .as3gg-popover-inner { padding: 3px; width: 280px; overflow: hidden; background: #000000; background: rgba(0, 0, 0, 0.8); -webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; -webkit-box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3); -moz-box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3); box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3); } .as3gg-popover-title { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 18px; margin: 0; font-weight: bold; color: #333333; text-rendering: optimizelegibility; padding: 9px 15px; line-height: 1; background-color: #f5f5f5; border-bottom: 1px solid #eee; -webkit-border-radius: 3px 3px 0 0; -moz-border-radius: 3px 3px 0 0; border-radius: 3px 3px 0 0; } .as3gg-popover-content { padding: 14px; background-color: #ffffff; -webkit-border-radius: 0 0 3px 3px; -moz-border-radius: 0 0 3px 3px; border-radius: 0 0 3px 3px; -webkit-background-clip: padding-box; -moz-background-clip: padding-box; background-clip: padding-box; } .as3gg-popover-content p, .as3gg-popover-content ul, .as3gg-popover-content ol { margin-bottom: 0; } .as3gg-sideinfo { color: #000; } .as3gg-sideinfo img { display: none; float: left; margin: 0 2px 0 0; } .as3gg-sideinfo p { text-align: left; text-decoration: none; color: #666; margin-bottom: 15px; } .as3gg-sideinfo p strong, a:link, a:hover, a:active, a:visited { text-align: left; color: #000; } </style>'));
});


/* ===========================================================
 * bootstrap-tooltip.js v2.0.1
 * http://twitter.github.com/bootstrap/javascript.html#tooltips
 * Inspired by the original jQuery.tipsy by Jason Frame
 * ===========================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */

!function( $ ) {

  "use strict"

 /* TOOLTIP PUBLIC CLASS DEFINITION
  * =============================== */

  var Tooltip = function ( element, options ) {
    this.init('tooltip', element, options)
  }

  Tooltip.prototype = {

    constructor: Tooltip

  , init: function ( type, element, options ) {
      var eventIn
        , eventOut

      this.type = type
      this.$element = $(element)
      this.options = this.getOptions(options)
      this.enabled = true

      if (this.options.trigger != 'manual') {
        eventIn  = this.options.trigger == 'hover' ? 'mouseenter' : 'focus'
        eventOut = this.options.trigger == 'hover' ? 'mouseleave' : 'blur'
        this.$element.on(eventIn, this.options.selector, $.proxy(this.enter, this))
        this.$element.on(eventOut, this.options.selector, $.proxy(this.leave, this))
      }

      this.options.selector ?
        (this._options = $.extend({}, this.options, { trigger: 'manual', selector: '' })) :
        this.fixTitle()
    }

  , getOptions: function ( options ) {
      options = $.extend({}, $.fn[this.type].defaults, options, this.$element.data())

      if (options.delay && typeof options.delay == 'number') {
        options.delay = {
          show: options.delay
        , hide: options.delay
        }
      }

      return options
    }

  , enter: function ( e ) {
      var self = $(e.currentTarget)[this.type](this._options).data(this.type)

      if (!self.options.delay || !self.options.delay.show) {
        self.show()
      } else {
        self.hoverState = 'in'
        setTimeout(function() {
          if (self.hoverState == 'in') {
            self.show()
          }
        }, self.options.delay.show)
      }
    }

  , leave: function ( e ) {
      var self = $(e.currentTarget)[this.type](this._options).data(this.type)

      if (!self.options.delay || !self.options.delay.hide) {
        self.hide()
      } else {
        self.hoverState = 'out'
        setTimeout(function() {
          if (self.hoverState == 'out') {
            self.hide()
          }
        }, self.options.delay.hide)
      }
    }

  , show: function () {
      var $tip
        , inside
        , pos
        , actualWidth
        , actualHeight
        , placement
        , tp

      if (this.hasContent() && this.enabled) {
        $tip = this.tip()
        this.setContent()

        if (this.options.animation) {
          $tip.addClass('fade')
        }

        placement = typeof this.options.placement == 'function' ?
          this.options.placement.call(this, $tip[0], this.$element[0]) :
          this.options.placement

        inside = /in/.test(placement)

        $tip
          .remove()
          .css({ top: 0, left: 0, display: 'block' })
          .appendTo(inside ? this.$element : document.body)

        pos = this.getPosition(inside)

        actualWidth = $tip[0].offsetWidth
        actualHeight = $tip[0].offsetHeight

        switch (inside ? placement.split(' ')[1] : placement) {
          case 'bottom':
            tp = {top: pos.top + pos.height, left: pos.left + pos.width / 2 - actualWidth / 2}
            break
          case 'top':
            tp = {top: pos.top - actualHeight, left: pos.left + pos.width / 2 - actualWidth / 2}
            break
          case 'left':
            tp = {top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left - actualWidth}
            break
          case 'right':
            tp = {top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left + pos.width}
            break
        }

        $tip
          .css(tp)
          .addClass(placement)
          .addClass('in')
      }
    }

  , setContent: function () {
      var $tip = this.tip()
      $tip.find('.tooltip-inner').html(this.getTitle())
      $tip.removeClass('fade in top bottom left right')
    }

  , hide: function () {
      var that = this
        , $tip = this.tip()

      $tip.removeClass('in')

      function removeWithAnimation() {
        var timeout = setTimeout(function () {
          $tip.off($.support.transition.end).remove()
        }, 500)

        $tip.one($.support.transition.end, function () {
          clearTimeout(timeout)
          $tip.remove()
        })
      }

      $.support.transition && this.$tip.hasClass('fade') ?
        removeWithAnimation() :
        $tip.remove()
    }

  , fixTitle: function () {
      var $e = this.$element
      if ($e.attr('title') || typeof($e.attr('data-original-title')) != 'string') {
        $e.attr('data-original-title', $e.attr('title') || '').removeAttr('title')
      }
    }

  , hasContent: function () {
      return this.getTitle()
    }

  , getPosition: function (inside) {
      return $.extend({}, (inside ? {top: 0, left: 0} : this.$element.offset()), {
        width: this.$element[0].offsetWidth
      , height: this.$element[0].offsetHeight
      })
    }

  , getTitle: function () {
      var title
        , $e = this.$element
        , o = this.options

      title = $e.attr('data-original-title')
        || (typeof o.title == 'function' ? o.title.call($e[0]) :  o.title)

      title = title.toString().replace(/(^\s*|\s*$)/, "")

      return title
    }

  , tip: function () {
      return this.$tip = this.$tip || $(this.options.template)
    }

  , validate: function () {
      if (!this.$element[0].parentNode) {
        this.hide()
        this.$element = null
        this.options = null
      }
    }

  , enable: function () {
      this.enabled = true
    }

  , disable: function () {
      this.enabled = false
    }

  , toggleEnabled: function () {
      this.enabled = !this.enabled
    }

  , toggle: function () {
      this[this.tip().hasClass('in') ? 'hide' : 'show']()
    }

  }


 /* TOOLTIP PLUGIN DEFINITION
  * ========================= */

  $.fn.tooltip = function ( option ) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('tooltip')
        , options = typeof option == 'object' && option
      if (!data) $this.data('tooltip', (data = new Tooltip(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }

  $.fn.tooltip.Constructor = Tooltip

  $.fn.tooltip.defaults = {
    animation: true
  , delay: 0
  , selector: false
  , placement: 'top'
  , trigger: 'hover'
  , title: ''
  , template: '<div class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
  }

}( window.jQuery );
/* ===========================================================
 * bootstrap-popover.js v2.0.1
 * http://twitter.github.com/bootstrap/javascript.html#popovers
 * ===========================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * =========================================================== */


!function( $ ) {

 "use strict"

  var Popover = function ( element, options ) {
    this.init('popover', element, options)
  }

  /* NOTE: POPOVER EXTENDS BOOTSTRAP-TOOLTIP.js
     ========================================== */

  Popover.prototype = $.extend({}, $.fn.tooltip.Constructor.prototype, {

    constructor: Popover

  , setContent: function () {
      var $tip = this.tip()
        , title = this.getTitle()
        , content = this.getContent()

      $tip.find('.popover-title')[ $.type(title) == 'object' ? 'append' : 'html' ](title)
      $tip.find('.popover-content > *')[ $.type(content) == 'object' ? 'append' : 'html' ](content)

      $tip.removeClass('fade top bottom left right in')
    }

  , hasContent: function () {
      return this.getTitle() || this.getContent()
    }

  , getContent: function () {
      var content
        , $e = this.$element
        , o = this.options

      content = $e.attr('data-content')
        || (typeof o.content == 'function' ? o.content.call($e[0]) :  o.content)

      content = content.toString().replace(/(^\s*|\s*$)/, "")

      return content
    }

  , tip: function() {
      if (!this.$tip) {
        this.$tip = $(this.options.template)
      }
      return this.$tip
    }

  })


 /* POPOVER PLUGIN DEFINITION
  * ======================= */

  $.fn.popover = function ( option ) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('popover')
        , options = typeof option == 'object' && option
      if (!data) $this.data('popover', (data = new Popover(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }
  
  $.fn.popover.test = function() {
	  trace("test!");
  }

  $.fn.popover.Constructor = Popover

  $.fn.popover.defaults = $.extend({} , $.fn.tooltip.defaults, {
    placement: 'right'
  , content: ''
  , template: '<div class="as3gg-popover"><div class="arrow"></div><div class="as3gg-popover-inner"><h3 class="as3gg-popover-title"></h3><div class="as3gg-popover-content"><p></p></div></div></div>'
  })

}( window.jQuery );