FROM mysql:8.0.23

ADD ./mysql/my.cnf /etc/mysql/conf.d/my-docker.cnf
RUN chown mysql:mysql /etc/mysql/conf.d/my-docker.cnf \
    && chmod 0644 /etc/mysql/conf.d/my-docker.cnf