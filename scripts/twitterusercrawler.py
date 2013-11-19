import urllib
import re
import os

def main(artistname):
    
    artist = ' '.join(artistname.split('_'))
    print userfind(artist)

    
def userfind(username):
    pagelink = makepagelink(username)   #'https://twitter.com/search?q=gareth%20bale&src=typd&mode=users'
    page = urllib.urlopen(pagelink).read()
    page=" ".join(page.split())
    userexp = '<div class=\"content\">.*<span class=\"username js\-action\-profile\-name\">'
    userpage = ''.join(re.findall(userexp,page))
    verifyicon = 'icon verified'
    if verifyicon in userpage:
        start = userpage.find('@')
        end = userpage[start+1:].find('<')
        
        user = userpage[start+1:start+end+1]
        return user
    else:
        return "$none$"


def makepagelink(username):
    link = 'https://twitter.com/search?q='
    username = username.lower()
    username = username.split()
    wordcount=0
    for word in username:
        if wordcount == len(username)-1:
            link = link + word+'&src=typd&mode=users'
        else:
            link = link +word +'%20'
        wordcount+=1
    return link
            
if __name__ == '__main__':
    	import sys
	if len(sys.argv)<2:
		print "python twitterusercrawler.py artistname"
		sys.exit()
	main(sys.argv[1])


#p = open("bale.txt","w")
#p.write(username)
