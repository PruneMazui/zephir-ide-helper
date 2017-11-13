VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "centos/7"
  config.vm.network "forwarded_port", guest: 80, host: 8080, host_ip:"127.0.0.1"
  config.vm.synced_folder ".", "/source/"
  Encoding.default_external = 'UTF-8'

  config.vm.provider :virtualbox do |vb|
    # vb.gui = true
    vb.customize ["modifyvm", :id, "--memory", "1024"]
  end

  config.vm.provision :shell, inline: <<-SHELL
    yum install -y epel-release
    yum install -y http://rpms.famillecollet.com/enterprise/remi-release-7.rpm
    yum install -y --enablerepo=remi-php71 php php-devel php-xml php-pecl-zip php-pdo php-mbstring
    yum install -y gcc-c++ make automake re2c autoconf git unzip
    
    cd /usr/local/src
    git clone git://github.com/phalcon/php-zephir-parser.git
    cd php-zephir-parser/
    ./install

    cat <<EOT > /etc/php.d/zephir_parser.ini
[Zephir Parser]
extension=zephir_parser.so
EOT

    curl -sS https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer
    
    cd /source/
    php /usr/local/bin/composer install

SHELL

end
