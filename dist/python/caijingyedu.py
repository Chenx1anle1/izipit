#coding=utf-8
import urllib.request

def getHtml(url):
    page = urllib.request.urlopen(url)
    html = page.read()
    #print(type(html))
    html = html.decode('UTF-8')
    # print(html)
    # print('@@@@')
    return html

def getImg(html):
    head = "<title>"
    tail = "</title>"
    ph = html.find(head)
    pt = html.find(tail)
    music = html[ph + len(head):pt + len(tail) - 8]
    print(music)
    print('--------')


html = getHtml("http://bk2.radio.cn/mms4/videoPlay/getVodProgramPlayUrlJson.jspa?programId=654320&programVideoId=0&videoType=PC&terminalType=515104503&dflag=1")
getImg(html)