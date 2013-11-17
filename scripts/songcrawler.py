import urllib
import re
import os

def main(artistname):
    
    artist = ' '.join(artistname.split('_'))
    print makelinks(artist)
   
    

def makelinks(artist):
    pagelink = ''
    directory=''
    trackexp = ''
    filename = ''
    pagelink = 'http://www.last.fm/music/'
    #directory = 'C:/Users/Rohit/Desktop/Blurbspot/'
    trackexp = '<a href=\"/music/'
    #filename = ''
    words = artist.split()
    wordcount = 0
    for word in words:
        if wordcount == len(words)-1:
            pagelink = pagelink + word
            #directory = directory + word
            trackexp = trackexp + word
                
        else:
            pagelink = pagelink + word + '+'
            #directory = directory + word + '-'
            trackexp = trackexp + word + '\+'
        #filename = filename + word +'_'
        wordcount+=1
            
    pagelink = pagelink + '/+tracks'
    #directory = directory + '/'
    trackexp = trackexp + "/_/([^\">]+)\" >"
    #filename = filename + 'tracks.txt'
        #print pagelink, directory, trackexp, filename
    tracks = getsongs(pagelink, trackexp)
        #makefile(directory,filename,tracks)
    return tracks

def getsongs(pagelink,trackexp):
    
    page = urllib.urlopen(pagelink).read()
    page=" ".join(page.split())
    songs = '|'.join(re.findall(trackexp,page))
    songs = re.sub('\+',' ',songs)
    #stre = re.sub('<[^<]+?>', '', stre)
    return songs

   
    

#crawlsongs()
if __name__ == '__main__':
	import sys
	if len(sys.argv)<2:
		print "python songcrawler.py artistname"
		sys.exit()
	main(sys.argv[1])
