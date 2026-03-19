provider "aws" {
  region = var.region
}

resource "aws_instance" "web" {
  ami           = "ami-0c3705572bc0f5fdc" # Debian 
  instance_type = "t4g.small"
  key_name      = "aws_ssni"

  user_data = <<-EOF
            #!/bin/bash
            hostnamectl set-hostname ciga-server
            EOF

  tags = {
    Name = "ciga-server"
  }

  vpc_security_group_ids = [var.sg_id]

  provisioner "local-exec" {
    command = <<EOT
    echo "[web]" > ../ansible/host.txt
    echo "${self.public_ip} ansible_user=admin ansible_ssh_private_key_file=~/.ssh/aws_ssni.pem" >> ../ansible/host.txt
    sleep 30
    cd ../ansible
    ansible-playbook -i host.txt playbook.yml
  EOT
  }
}