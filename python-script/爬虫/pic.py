import re  
import urllib  
      
def getHtml(url):  
        page = urllib.urlopen(url)  
        html = page.read()  
        return html  
      
def getImg(html):  
        reg = r'"(http://fuss10.elemecdn.com.+?\.jpeg)"'
        imgre = re.compile(reg)  
        imglist = imgre.findall(html)
        for i in imglist:
          print str(i)  
        x = 76
        for imgurl in imglist:  
            urllib.urlretrieve(imgurl,'%s.jpeg' % x)  
            x = x + 1
         
html = getHtml("http://r.ele.me/jfgfbz")  
getImg(html)  
