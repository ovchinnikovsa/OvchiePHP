var CustomSelect={addF:function(){var e,t,s,n,c,l,a,i,o,d=[];for(n=(e=document.getElementsByClassName("custom-select")).length,t=0;t<n;t++){for(c=(l=e[t].getElementsByTagName("select")[0]).length,(a=document.createElement("DIV")).setAttribute("class","custom-select__select-selected"),a.innerHTML=l.options[l.selectedIndex].innerHTML,e[t].appendChild(a),(i=document.createElement("DIV")).setAttribute("class","custom-select__select-items custom-select__select-hide"),s=0;s<c;s++)(o=document.createElement("DIV")).innerHTML=l.options[s].innerHTML,o.dataset.value=l.options[s].value,o.dataset.name=l.name,o.addEventListener("click",function(e){var t,s,n,c,l,a,i;for(a=(c=this.parentNode.parentNode.getElementsByTagName("select")[0]).length,l=this.parentNode.previousSibling,s=0;s<a;s++)if(c.options[s].innerHTML==this.innerHTML){for(c.selectedIndex=s,l.innerHTML=this.innerHTML,i=(t=this.parentNode.getElementsByClassName("custom-select__same-as-selected")).length,n=0;n<i;n++)t[n].removeAttribute("class");this.setAttribute("class","custom-select__same-as-selected");break}d.forEach(function(e){e(this.dataset.name,this.dataset.value)}.bind(this)),l.click()}),i.appendChild(o);e[t].appendChild(i),a.addEventListener("click",function(e){e.stopPropagation(),m(this),this.nextSibling.classList.toggle("custom-select__select-hide"),this.classList.toggle("custom-select__select-arrow-active")})}function m(e){var t,s,n,c,l,a=[];for(t=document.getElementsByClassName("custom-select__select-items"),s=document.getElementsByClassName("custom-select__select-selected"),c=t.length,l=s.length,n=0;n<l;n++)e==s[n]?a.push(n):s[n].classList.remove("custom-select__select-arrow-active");for(n=0;n<c;n++)a.indexOf(n)&&t[n].classList.add("custom-select__select-hide")}return document.addEventListener("click",m),function(e){d.push(e)}}()};