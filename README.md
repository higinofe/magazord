README de Instalação
Requisitos
Sistema operacional: Ubuntu Server 22.04 LTS

Servidor web: Apache 2

Banco de dados: MySQL

PHP (versão compatível com seu projeto)

Composer (gerenciador de dependências PHP)

Doctrine ORM (para gerenciamento do banco de dados)

Passo 1: Atualizar o Sistema
Antes de começar, atualize os pacotes do Ubuntu para garantir que tudo esteja na versão mais recente.

bash
Copiar
Editar
sudo apt update && sudo apt upgrade -y
Passo 2: Instalar Apache
Instale o servidor Apache:

bash
Copiar
Editar
sudo apt install apache2 -y
Verifique se o Apache está rodando:

bash
Copiar
Editar
sudo systemctl status apache2
Se não estiver ativo, inicie com:

bash
Copiar
Editar
sudo systemctl start apache2
Ative para iniciar junto com o sistema:

bash
Copiar
Editar
sudo systemctl enable apache2
Passo 3: Instalar MySQL
Instale o MySQL Server:

bash
Copiar
Editar
sudo apt install mysql-server -y
Verifique o status do MySQL:

bash
Copiar
Editar
sudo systemctl status mysql
Se necessário, inicie e habilite:

bash
Copiar
Editar
sudo systemctl start mysql
sudo systemctl enable mysql
Configuração inicial do MySQL
Execute o script de segurança:

bash
Copiar
Editar
sudo mysql_secure_installation
Siga as instruções para definir a senha root, remover usuários anônimos, desabilitar login remoto root, etc.

Passo 4: Instalar PHP e Extensões Necessárias
Instale PHP (versão compatível com seu projeto) e extensões comuns para Laravel / Doctrine:

bash
Copiar
Editar
sudo apt install php php-cli php-common php-mbstring php-xml php-mysql php-curl php-zip php-intl libapache2-mod-php -y
Verifique a versão do PHP:

bash
Copiar
Editar
php -v
Passo 5: Configurar Apache para o Projeto
Crie o diretório do projeto (se ainda não existir):

bash
Copiar
Editar
sudo mkdir -p /var/www/seu_projeto
sudo chown -R $USER:$USER /var/www/seu_projeto
Copie o código do projeto para /var/www/seu_projeto (via git clone, scp, etc).

Crie um arquivo de configuração do Apache para seu projeto:

bash
Copiar
Editar
sudo nano /etc/apache2/sites-available/seu_projeto.conf
Exemplo básico de configuração:

apacheconf
Copiar
Editar
<VirtualHost *:80>
    ServerName seu_dominio_ou_ip

    DocumentRoot /var/www/seu_projeto/public

    <Directory /var/www/seu_projeto/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/seu_projeto_error.log
    CustomLog ${APACHE_LOG_DIR}/seu_projeto_access.log combined
</VirtualHost>
Ative o site e o módulo rewrite:

bash
Copiar
Editar
sudo a2ensite seu_projeto.conf
sudo a2enmod rewrite
Reinicie o Apache para aplicar as configurações:

bash
Copiar
Editar
sudo systemctl restart apache2
Passo 6: Configurar Banco de Dados MySQL para o Projeto
Entre no MySQL:

bash
Copiar
Editar
sudo mysql -u root -p
Crie o banco de dados e usuário para seu projeto:

sql
Copiar
Editar
CREATE DATABASE nome_do_banco CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'usuario'@'localhost' IDENTIFIED BY 'senha_segura';
GRANT ALL PRIVILEGES ON nome_do_banco.* TO 'usuario'@'localhost';
FLUSH PRIVILEGES;
EXIT;
Configure as credenciais no arquivo .env do seu projeto, por exemplo:

ini
Copiar
Editar
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha_segura
Passo 7: Instalar Composer
Verifique se o Composer já está instalado:

bash
Copiar
Editar
composer -V
Se não estiver, instale:

bash
Copiar
Editar
cd ~
curl -sS https://getcomposer.org/installer -o composer-setup.php
php composer-setup.php --install-dir=/usr/local/bin --filename=composer
Verifique novamente a versão para confirmar:

bash
Copiar
Editar
composer -V
Passo 8: Instalar Dependências do Projeto com Composer
No diretório do seu projeto, rode:

bash
Copiar
Editar
cd /var/www/seu_projeto
composer install
Passo 9: Instalar e Configurar o Banco de Dados com Doctrine
Para rodar o comando de criação do banco de dados e migrations com Doctrine, geralmente você terá comandos do tipo:

bash
Copiar
Editar
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
Passos:

Certifique-se que o arquivo config/packages/doctrine.yaml está configurado com as credenciais do banco de dados.

Crie o banco de dados (se não criado no MySQL manualmente):

bash
Copiar
Editar
php bin/console doctrine:database:create
Execute as migrations para criar as tabelas:

bash
Copiar
Editar
php bin/console doctrine:migrations:migrate
Se você estiver usando outro comando para a instalação do banco, utilize-o conforme documentação do seu projeto.

Passo 10: Permissões Finais
Ajuste as permissões para a pasta var e vendor se necessário (dependendo do framework):

bash
Copiar
Editar
sudo chown -R www-data:www-data /var/www/seu_projeto/var
sudo chown -R www-data:www-data /var/www/seu_projeto/vendor
Passo 11: Testar Acesso
Abra o navegador e acesse:

arduino
Copiar
Editar
http://seu_dominio_ou_ip
Se tudo estiver configurado corretamente, seu projeto deverá aparecer.

Dicas Extras
Para visualizar logs do Apache:

bash
Copiar
Editar
sudo tail -f /var/log/apache2/seu_projeto_error.log
Para reiniciar o Apache após qualquer alteração:

bash
Copiar
Editar
sudo systemctl restart apache2
