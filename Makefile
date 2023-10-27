VERSION := $(shell cat VERSION)

bump-version:
	echo $(VERSION) | awk -F. '{print $$1"."$$2"."$$3+1}' > VERSION

build-docker:
	docker build -t marmotteio/marmotteio:$(VERSION) .
	docker tag marmotteio/marmotteio:$(VERSION) marmotteio/marmotteio:latest

push-docker:
	docker push marmotteio/marmotteio:$(VERSION)
	docker push marmotteio/marmotteio:latest

git:
	git add -A
	opencommit
	git tag v$(VERSION)

push-git:
	git push
	git push --tags

release: git bump-version build-docker push-docker push-git
