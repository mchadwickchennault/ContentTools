FROM percona:5.7
COPY ./my.cnf /etc/mysql/conf.d/
ENV TZ=UTC
RUN echo $TZ | tee /etc/timezone
RUN dpkg-reconfigure --frontend noninteractive tzdata
