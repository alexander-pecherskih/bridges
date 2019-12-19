FROM alpine:3.8

# https://sphinxsearch.com/blog/
ENV SPHINX_VERSION 3.1.1-612d99f

# install dependencies
RUN apk add --no-cache mariadb-connector-c-dev wget

# set up and expose directories
#RUN mkdir -pv /opt/sphinx/log /opt/sphinx/index
#VOLUME /opt/sphinx/index

RUN mkdir -pv /var/data

RUN wget http://sphinxsearch.com/files/sphinx-${SPHINX_VERSION}-linux-amd64-musl.tar.gz -O /tmp/sphinxsearch.tar.gz
RUN mkdir /tmp/sphinx && tar -xf /tmp/sphinxsearch.tar.gz -C /tmp
RUN cd /tmp/sphinx-3.1.1/bin && mv indexer indextool searchd wordbreaker /usr/bin
RUN mv /tmp/sphinx-3.1.1/etc/sphinx.conf.dist /etc/sphinx.conf

RUN rm -rf /tmp/sphinxsearch.tar.gz /tmp/sphinx-3.1.1

# redirect logs to stdout
RUN ln -sv /dev/stdout /var/log/query.log
RUN ln -sv /dev/stdout /var/log/searchd.log

#RUN indexer -v

CMD searchd --config /etc/sphinx.conf --nodetach