import urllib
import re
import os

def main(artistname):
    artistlist =[]
    artist = ' '.join(artistname.split('_'))
    print makelinks(artist)
   
    



def makelinks(artist):
    pagelink = ''
    directory=''
    imageexp = "width=\"[0-9]+\" src=\"http://userserve([^\">]+)\" />"
    imageurl = "http://userserve"
    filename = ''
    pagelink = 'http://www.last.fm/music/'
    #directory = 'C:/Users/Rohit/Desktop/Blurbspot/'
        
    #filename = ''
    words = artist.split()
    wordcount = 0
    for word in words:
        if wordcount == len(words)-1:
            pagelink = pagelink + word
            #directory = directory + word
                
                
        else:
            pagelink = pagelink + word + '+'
            #directory = directory + word + '-'
                
        filename = filename + word +'_'
        wordcount+=1
            
    pagelink = pagelink + '/+images'
    #directory = directory + '/'
        #imageexp = imageexp + "([^\">]+)\" >"
    #filename = filename + 'images.txt'
    imagelist = getimages(pagelink, imageexp)
    imagelist = [imageurl+image for image in imagelist]
        
    images =  '|'.join(imagelist)
    #makefile(directory,filename,images)
    return images

def getimages(pagelink,imageexp):
    
    page = urllib.urlopen(pagelink).read()
    page=" ".join(page.split())
    images = re.findall(imageexp,page)
    #songs = re.sub('\+',' ',songs)
    #stre = re.sub('<[^<]+?>', '', stre)
    return images


    
    

#crawlimages()
if __name__ == '__main__':
	import sys
	if len(sys.argv)<2:
		print "python songcrawler.py artistname"
		sys.exit()
	main(sys.argv[1])
